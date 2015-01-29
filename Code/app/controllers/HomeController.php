<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{

        /*
                $other_news = $this->getOtherNews();
                $major_stories = $this->getMajorStories();
                $featured_story= $this->getFeaturedStory();
                $story_so_far = $this->getStorySoFar($featured_story->id);
        */

		return View::make('hello');
	}

}
