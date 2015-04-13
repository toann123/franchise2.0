<?php
/** @package    FRANCHISE::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/Customer.php");

/**
 * CustomerController is the controller class for the Customer object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package FRANCHISE::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class CustomerController extends AppBaseController
{

	/**
	 * Override here for any controller-specific functionality
	 *
	 * @inheritdocs
	 */
	protected function Init()
	{
		parent::Init();

		// TODO: add controller-wide bootstrap code
		
		// TODO: if authentiation is required for this entire controller, for example:
		// $this->RequirePermission(ExampleUser::$PERMISSION_USER,'SecureExample.LoginForm');
	}

	/**
	 * Displays a list view of Customer objects
	 */
	public function ListView()
	{
		$this->Render("CustomerListView.tpl");
	}
    
    public function AddListView()
	{
		$this->Render("AddCustomerListView.tpl");
	}

	/**
	 * API Method queries for Customer records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new CustomerCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Id,Firstname,Lastname,AccountId,BranchName,Phone,Mobile,Email,Address,Suburb,Postcode,State,City,CreatedBy,CreatedDate,UpdatedDate,Status'
				, '%'.$filter.'%')
			);

			// TODO: this is generic query filtering based only on criteria properties
			foreach (array_keys($_REQUEST) as $prop)
			{
				$prop_normal = ucfirst($prop);
				$prop_equals = $prop_normal.'_Equals';

				if (property_exists($criteria, $prop_normal))
				{
					$criteria->$prop_normal = RequestUtil::Get($prop);
				}
				elseif (property_exists($criteria, $prop_equals))
				{
					// this is a convenience so that the _Equals suffix is not needed
					$criteria->$prop_equals = RequestUtil::Get($prop);
				}
			}

			$output = new stdClass();

			// if a sort order was specified then specify in the criteria
 			$output->orderBy = RequestUtil::Get('orderBy');
 			$output->orderDesc = RequestUtil::Get('orderDesc') != '';
 			if ($output->orderBy) $criteria->SetOrder($output->orderBy, $output->orderDesc);

			$page = RequestUtil::Get('page');

			if ($page != '')
			{
				// if page is specified, use this instead (at the expense of one extra count query)
				$pagesize = $this->GetDefaultPageSize();

				$customers = $this->Phreezer->Query('Customer',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $customers->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $customers->TotalResults;
				$output->totalPages = $customers->TotalPages;
				$output->pageSize = $customers->PageSize;
				$output->currentPage = $customers->CurrentPage;
			}
			else
			{
				// return all results
				$customers = $this->Phreezer->Query('Customer',$criteria);
				$output->rows = $customers->ToObjectArray(true, $this->SimpleObjectParams());
				$output->totalResults = count($output->rows);
				$output->totalPages = 1;
				$output->pageSize = $output->totalResults;
				$output->currentPage = 1;
			}


			$this->RenderJSON($output, $this->JSONPCallback());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method retrieves a single Customer record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('id');
			$customer = $this->Phreezer->Get('Customer',$pk);
			$this->RenderJSON($customer, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new Customer record and render response as JSON
	 */
	public function Create()
	{
		try
		{
						
			$json = json_decode(RequestUtil::GetBody());

			if (!$json)
			{
				throw new Exception('The request body does not contain valid JSON');
			}

			$customer = new Customer($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $customer->Id = $this->SafeGetVal($json, 'id');

			$customer->Firstname = $this->SafeGetVal($json, 'firstname');
			$customer->Lastname = $this->SafeGetVal($json, 'lastname');
			$customer->AccountId = $this->SafeGetVal($json, 'accountId');
			$customer->BranchName = $this->SafeGetVal($json, 'branchName');
			$customer->Phone = $this->SafeGetVal($json, 'phone');
			$customer->Mobile = $this->SafeGetVal($json, 'mobile');
			$customer->Email = $this->SafeGetVal($json, 'email');
			$customer->Address = $this->SafeGetVal($json, 'address');
			$customer->Suburb = $this->SafeGetVal($json, 'suburb');
			$customer->Postcode = $this->SafeGetVal($json, 'postcode');
			$customer->State = $this->SafeGetVal($json, 'state');
			$customer->City = $this->SafeGetVal($json, 'city');
			$customer->CreatedBy = $this->SafeGetVal($json, 'createdBy');
			$customer->CreatedDate = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'createdDate')));
			$customer->UpdatedDate = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'updatedDate')));
			$customer->Status = $this->SafeGetVal($json, 'status');

			$customer->Validate();
			$errors = $customer->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$customer->Save();
				$this->RenderJSON($customer, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing Customer record and render response as JSON
	 */
	public function Update()
	{
		try
		{
						
			$json = json_decode(RequestUtil::GetBody());

			if (!$json)
			{
				throw new Exception('The request body does not contain valid JSON');
			}

			$pk = $this->GetRouter()->GetUrlParam('id');
			$customer = $this->Phreezer->Get('Customer',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $customer->Id = $this->SafeGetVal($json, 'id', $customer->Id);

			$customer->Firstname = $this->SafeGetVal($json, 'firstname', $customer->Firstname);
			$customer->Lastname = $this->SafeGetVal($json, 'lastname', $customer->Lastname);
			$customer->AccountId = $this->SafeGetVal($json, 'accountId', $customer->AccountId);
			$customer->BranchName = $this->SafeGetVal($json, 'branchName', $customer->BranchName);
			$customer->Phone = $this->SafeGetVal($json, 'phone', $customer->Phone);
			$customer->Mobile = $this->SafeGetVal($json, 'mobile', $customer->Mobile);
			$customer->Email = $this->SafeGetVal($json, 'email', $customer->Email);
			$customer->Address = $this->SafeGetVal($json, 'address', $customer->Address);
			$customer->Suburb = $this->SafeGetVal($json, 'suburb', $customer->Suburb);
			$customer->Postcode = $this->SafeGetVal($json, 'postcode', $customer->Postcode);
			$customer->State = $this->SafeGetVal($json, 'state', $customer->State);
			$customer->City = $this->SafeGetVal($json, 'city', $customer->City);
			$customer->CreatedBy = $this->SafeGetVal($json, 'createdBy', $customer->CreatedBy);
			$customer->CreatedDate = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'createdDate', $customer->CreatedDate)));
			$customer->UpdatedDate = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'updatedDate', $customer->UpdatedDate)));
			$customer->Status = $this->SafeGetVal($json, 'status', $customer->Status);

			$customer->Validate();
			$errors = $customer->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$customer->Save();
				$this->RenderJSON($customer, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing Customer record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('id');
			$customer = $this->Phreezer->Get('Customer',$pk);

			$customer->Delete();

			$output = new stdClass();

			$this->RenderJSON($output, $this->JSONPCallback());

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}
}

?>
