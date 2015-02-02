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
                        $other_news = "";//$this->getOtherNews();

                        $major_stories = "";//$this->getMajorStories();

                        $featured_story= "";//$this->getFeaturedStory();

                        $story_so_far = "";//$this->getStorySoFar($featured_story->id);

                        $data = array(
                            "other_news"=>$other_news,
                            "major_stories"=>$major_stories,
                            "featured_story"=>$featured_story,
                            "story_so_far"=>$story_so_far
                        );

                return View::make('hello', $data);
        */

        return $this->getStories();
	}

    public function getStories(){
        //get all stories, loop and classify
        $url = "http://localhost/ziwaphi/?json=get_category_posts&id=8";

        $posts = $this->file_get_contents_curl($url);

                

        return $posts;

    }

    public function file_get_contents_curl($url){


        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);

        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

}
