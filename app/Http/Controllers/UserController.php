<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Http;
use Illuminate\Pagination\LengthAwarePaginator; // Correct import
class UserController extends Controller
{
	public function index(Request $request){
		$response = Http::get('https://jsonplaceholder.typicode.com/posts');
        $posts = $response->json();

        // Get the search query from the request
        $search = $request->input('search');

        // Filter the posts by title if search is provided
        if ($search) {
            $posts = array_filter($posts, function ($post) use ($search) {
                //return stripos($post['title'], $search) !== false;
				return stripos($post['title'], $search) !== false || stripos($post['body'], $search) !== false
            });
        }

        // Paginate the filtered data
        $perPage = 10; // Number of items per page
        $currentPage = $request->input('page', 1);
        $offset = ($currentPage - 1) * $perPage;

        $paginatedData = new LengthAwarePaginator(
            array_slice($posts, $offset, $perPage),
            count($posts),
            $perPage,
            $currentPage,
            ['path' => url()->current()]
        );

        return view('table', compact('paginatedData', 'search'));

	}
	
	
	
	
	
	
	
    public function index_without_filter(Request $request){
		$data=Http::get('https://jsonplaceholder.typicode.com/posts');
		$posts=$data->json();
		$perPage = 10;
		$currentPage = $request->input('page', 1);
		$offset = ($currentPage - 1) * $perPage;
		$paginatedData = new LengthAwarePaginator(
            array_slice($posts, $offset, $perPage),
            count($posts),
            $perPage,
            $currentPage,
            ['path' => url()->current()]
        );
		
		return view('table', compact('paginatedData'));
	}
	
	public function placeholder(){
		
		
	}
}
