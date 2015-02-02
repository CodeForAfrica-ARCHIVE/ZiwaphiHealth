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

        $data = $this->getStories();
        return View::make('hello', $data);
	}

    public function getStories(){

        //get all stories, loop and classify
        $url = "http://localhost/ziwaphi/?json=get_category_posts&id=8";

        $result = json_decode($this->file_get_contents_curl($url));

        $posts = $result->posts;



        //if has add to major stories array
                //pick first major story as featured
                    //get related stories
        //else
                //add to other stories

        $sorted_posts = array("major_stories"=>array(), "other_stories"=>array(), "tags"=>array());

        $featured = 0;

        foreach($posts as $p){

            $major_story = false;

            //get posts tags
            foreach($p->tags as $tag){
                if($tag->slug == "featured"){
                    //is major story
                    $major_story = true;
                }else{
                    //add tags + count of total articles with tags
                    if(!array_key_exists($tag->slug, $sorted_posts['tags'])){
                        $sorted_posts['tags'][$tag->slug] = 1;
                    }else{
                        $sorted_posts['tags'][$tag->slug]++;
                    }
                }
            }

            if($major_story){

                if($featured==0){
                    //first major story is featured
                    $sorted_posts['featured'] = $p;

                    $featured = 1;

                }else{

                    $sorted_posts['major_stories'][] = $p;

                }


            }else{

                $sorted_posts['other_stories'][] = $p;

            }


        }

        return $sorted_posts;

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
