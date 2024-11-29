<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Company;

class ArticleController extends Controller
{
    public function details()
    {
        $article = Article::getByUserId(auth()->user()->id);
        return view('frontend.user.article.getArticle', compact('article'));
    }

    public function editArticle(Request $request, $id)
    {
         // Convert $id to an integer
        $id = (int) $id;

        // Fetch the article data using the integer ID
        $article = Article::find($id);
        $data['category'] = Category::orderBy('name')->get(["name", "id"]);
        $data['company'] = Company::where('user_id', auth()->id())
            ->orderBy('company_name')
            ->get(['company_name', 'id']);
        if($article) {
            return view('frontend.user.article.editArticle', compact('article', 'data'));
        }else{
            alert('Article not found');
        }
    }

    public function editArticleb(Request $request)
{
    // Validate the incoming request data
    $validate = $request->validate([
        'category' => 'required|integer',                  // Ensure category is an integer
        'company_id' => 'required|integer',
        'title' => 'required|string|max:255',               // Title is required and should be a string with max length 255
        'meta_title' => 'nullable|string|max:255',          // Meta title is optional
        'description' => 'nullable|string',                 // Description is optional
        'meta_description' => 'nullable|string',            // Meta description is optional
        'meta_keywords' => 'nullable|string',               // Meta keywords are optional
        'content' => 'required|string',                     // Content is required for the article
    ]);

    // Find the article with ID = 1
    $article = Article::find((int) $request->input('id'));  // Always fetching article with ID = 1

    // Check if the article exists
    if (!$article) {
        // If article not found, redirect back with error message
        return redirect()->back()->with('error', 'Article not found!');
    }

    // Update the article's properties with the validated request data
    $article->category_id = (int) $validate['category'];        // Ensure category is cast to integer
    $article->conpany_id = (int) $validate['company_id'];
    $article->title = $validate['title'];                        // Update the title
    $article->meta_title = $validate['meta_title'];              // Update the meta_title (optional)
    $article->description = $validate['description'];            // Update the description (optional)
    $article->meta_description = $validate['meta_description'];  // Update the meta_description (optional)
    $article->meta_keywords = $validate['meta_keywords'];        // Update meta_keywords (optional)
    $article->content = $validate['content'];                    // Update the content of the article

    // Attempt to update the article in the database
    try {
        // Update the article and save the changes
        $article->update();

        // Notify user of success
        notifyEvs('success', 'Article updated successfully.');

        // Redirect back with success message
        return redirect()->back()->with('success', 'Article updated successfully!');
    } catch (\Exception $e) {
        // Handle errors during saving, you can log the error message if needed
        notifyEvs('error', 'An error occurred while updating the article.');
        
        // Redirect back with error message
        return redirect()->back()->with('error', 'An error occurred while updating the article. Please try again.');
    }
}

    public function deleteArticle($id)
    {
        $article = Article::find($id);
        if (!$article) {
            // Return an error message if the article is not found
            return redirect()->back()->with('error', 'Article not found.');
        }
        try {
            // Attempt to delete the article
            $article->delete();
    
            // Notify the user that the article has been deleted successfully
            return redirect()->route('user.articles')->with('success', 'Article deleted successfully.');
    
        } catch (\Exception $e) {
            // Handle errors during deletion
            return redirect()->back()->with('error', 'An error occurred while deleting the article.');
        }
    }
    

    public function addArticle()
    {
        $data['category'] = Category::orderBy('name')->get(["name", "id"]);
        $data['company'] = Company::where('user_id', auth()->id())
            ->orderBy('company_name')
            ->get(['company_name', 'id']);
        return view('frontend.user.article.addArticle', compact('data'));
    }

    public function addArticleF(Request $request)
    {
        // Validate the incoming request data
        $validate = $request->validate([
            'category' => 'required|integer',                  // Ensure category is an integer
            'company_id' => 'required|integer',
            'title' => 'required|string|max:255',               // Title is required and should be a string with max length 255
            'meta_title' => 'nullable|string|max:255',          // Meta title is optional
            'description' => 'nullable|string',                 // Description is optional
            'meta_description' => 'nullable|string',            // Meta description is optional
            'meta_keywords' => 'nullable|string',               // Meta keywords are optional
            'content' => 'required|string',
            'alt_tag' => 'required|string',                     // Content is required for the article
        ]);
        
    
        // Create a new article instance
        $article = new Article();
        
        // Set the article's properties from the validated request data
        $article->user_id = auth()->id();
        $article->category_id =(int) $validate['category'];        // Ensure category is cast to integer
        $article->company_id = (int) $validate['company_id'];
        $article->title = $validate['title'];                    // Save the title
        $article->meta_title = $validate['meta_title'];          // Save the meta_title (optional)
        $article->description = $validate['description'];        // Save the description (optional)
        $article->meta_description = $validate['meta_description']; // Save the meta_description (optional)
        $article->meta_keywords = $validate['meta_keywords'];    // Save meta_keywords (optional)
        $article->content = $validate['content'];               // Save the content of the article
        $article->alt_tag = $validate['alt_tag'];
        // dd($article);
        try {
            // Attempt to save the article to the database
            $article->save();
            // Notify user of success
            notifyEvs('success', 'Article created successfully.');
    
            // Redirect back with success message
            return redirect()->back()->with('success', 'Article created successfully!');
        } catch (\Exception $e) {
            // Handle errors during saving, you can log the error message if needed
            notifyEvs('error', 'An error occurred while creating the article.');
            
            // Redirect back with error message
            return redirect()->back()->with('error', 'An error occurred while creating the article. Please try again.');
        }
    }
    

}
