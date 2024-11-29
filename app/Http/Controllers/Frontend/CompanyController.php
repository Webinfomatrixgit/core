<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Country;
use App\Models\State;
use App\Models\Cities;

class CompanyController extends Controller
{
    public function details()
    {
        // Ensure user is authenticated
        $userId = auth()->id();
        if (!$userId) {
            return response()->json(['error' => 'User not authenticated'], 403);
        }

        // Fetch companies linked to the authenticated user
        try {
            $companies = Company::where('user_id', $userId)->orderBy('name')->get();
            // Debugging: Check the retrieved data
            if ($companies->isEmpty()) {
                return response()->json(['message' => 'No companies found for the user'], 404);
            }

            // Pass data to the view
            return view('frontend.user.company.getCompany', compact('companies'));
        } catch (\Exception $e) {
            // Catch and log any server errors
            
            \Log::error('Error fetching companies: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching companies'], 500);
        }
    }


    public function fetchCountries()
    {
        $data['states'] = Country::orderBy('name')->get(["name", "id"]);
        return response()->json($data);
    }
    public function fetchState(Request $request)
    {
        $data['states'] = State::where("country_id", $request->country_id)
            ->orderBy('name')
            ->get(["name", "id"]);

        return response()->json($data);
    }

   

    public function fetchCity(Request $request)
    {
        $data['cities'] = Cities::where("state_id", $request->state_id)
            ->orderBy('name')
            ->get(["name", "id"]);
                                      
        return response()->json($data);
    }

    public function addCompany()
    {
        $data['country'] = Country::orderBy('name')->get(["name", "id"]);
        return view('frontend.user.company.addCompany', compact('data'));
    }

    public function editCompany(Request $request, $id)
    {
         // Convert $id to an integer
        $id = (int) $id;

        // Fetch the article data using the integer ID
        $company = Company::find($id);
        if($company) {
            $data['country'] = Country::orderBy('name')->get(["name", "id"]);
            return view('frontend.user.company.editCompany', compact('company', 'data'));
        }else{
            alert('Company not found');
        }
    }

    public function deleteCompany($id)
    {
        $company = Company::find($id);
        
        if (!$company) {
            // Return an error message if the article is not found
            return redirect()->back()->with('error', 'Company not found.');
        }
        try {
            // Attempt to delete the article
            $company->delete();
    
            // Notify the user that the article has been deleted successfully
            return redirect()->route('user.articles')->with('success', 'Company deleted successfully.');
    
        } catch (\Exception $e) {
            // Handle errors during deletion
            return redirect()->back()->with('error', 'An error occurred while deleting the company.');
        }
    }

    public function addCompanyF(Request $request)
    {
        // Validate the incoming request data
        $validate = $request->validate([
            'name' => 'required|string',
            'company_name' => 'required|string',
            'address' => 'required|string',
            'description' => 'nullable|string',
            'email' => 'nullable|string',
            'phone' => 'nullable|string',
            'website' => 'required|string',
            'city_id' => 'required|string',
            'state_id' =>  'required|string',
            'country_id' =>  'required|string',   
            'logo_url' =>  'required|string',
        ]);
        
        // dd($request);
    //     // Create a new article instance
        $company = new Company();
        
        // Set the article's properties from the validated request data
        $company->user_id = auth()->id();
        $company->name = $validate['name'];        // Ensure category is cast to integer 
        $company->company_name = $validate['company_name'];
        $company->description = $validate['description'];          // Save the meta_title (optional)
        $company->email = $validate['email'];        // Save the description (optional)
        $company->phone = $validate['phone'];        // Save the meta_description (optional)
        $company->website = $validate['website'];    // Save meta_keywords (optional)
        $company->city_id = (int) $validate['city_id'];  
        $company->state_id = (int) $validate['state_id'];             // Save the content of the article
        $company->country_id = (int) $validate['country_id'];
        $company->logo = $validate['logo_url'];
        $company->address = $validate['address'];
        
        try {
            // Attempt to save the article to the database
            
            $company->save();
            // Notify user of success
            notifyEvs('success', 'Company created successfully.');
    
            // Redirect back with success message
            return redirect()->back()->with('success', 'Company created successfully!');
        } catch (\Exception $e) {
            dd($e);
            // Handle errors during saving, you can log the error message if needed
            notifyEvs('error', 'An error occurred while creating the article.');
            
            // Redirect back with error message
            return redirect()->back()->with('error', 'An error occurred while creating the company. Please try again.');
        }
    }

    public function editCompanyb(Request $request) 
    {
         // Validate the incoming request data
         $validate = $request->validate([
            'name' => 'required|string',
            'company_name' => 'required|string',
            'address' => 'required|string',
            'description' => 'nullable|string',
            'email' => 'nullable|string',
            'phone' => 'nullable|string',
            'website' => 'required|string',
            'city_id' => 'required|string',
            'state_id' =>  'required|string',
            'country_id' =>  'required|string',   
            'logo_url' =>  'required|string',
        ]);
        
        // Create a new company instance
        $company = Company::find((int) $request->input('id'));

        // Check if the company exists
        if (!$company) {
            // If article not found, redirect back with error message
            return redirect()->back()->with('error', 'Company not found!');
        }
        
        // Set the article's properties from the validated request data
        $company->user_id = auth()->id();
        $company->name = $validate['name'];        // Ensure category is cast to integer
        $company->company_name = $validate['company_name'];                    // Save the title
        $company->address = $validate['address'];
        $company->description = $validate['description'];          // Save the meta_title (optional)
        $company->email = $validate['email'];        // Save the description (optional)
        $company->phone = $validate['phone'];        // Save the meta_description (optional)
        $company->website = $validate['website'];    // Save meta_keywords (optional)
        $company->city_id = (int) $validate['city_id'];  
        $company->state_id = (int) $validate['state_id'];             // Save the content of the article
        $company->country_id = (int) $validate['country_id'];
        $company->logo = $validate['logo_url'];
        // dd($company);
         // Attempt to update the article in the database
        try {
            // Update the article and save the changes
            $company->update();

            // Notify user of success
            notifyEvs('success', 'Company updated successfully.');

            // Redirect back with success message
            return redirect()->back()->with('success', 'Company updated successfully!');
        } catch (\Exception $e) {
            // Handle errors during saving, you can log the error message if needed
            notifyEvs('error', 'An error occurred while updating the company.');
            
            // Redirect back with error message
            return redirect()->back()->with('error', 'An error occurred while updating the company. Please try again.');
        }
    }

}
