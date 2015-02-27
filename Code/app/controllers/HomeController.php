<?php

class HomeController extends BaseController {


	public function showWelcome()
	{

        $data = $this->getStories();
        return View::make('hello', $data);
	}

    public function getStories(){


        //get all stories, loop and classify
        $url = Config::get('custom_config.WPFeedRoot') . "?json=get_category_posts&id=".Config::get('custom_config.WP_HealthCategory');

        $result = json_decode($this->file_get_contents_curl($url));

        $helpdesk = array("helpline"=>$this->getHelpLine(), "supportgroup"=>$this->getSupportGroup(), "socialmedia"=>$this->getSocialMedia());

        $sorted_posts = array("major_stories"=>array(), "other_stories"=>array(), "tags"=>array(), "featured"=>null, "helpdesk"=>$helpdesk);

        if ($result != null){
            $posts = $result->posts;


            $featured = 0;

            foreach($posts as $p){

                $major_story = false;

                //get posts tags
                foreach($p->tags as $tag){
                    if($tag->slug == "featured"){
                        //is major story
                        $major_story = true;
                    }else{
                        /*
                        //add tags + count of total articles with tags
                        if(!array_key_exists($tag->title, $sorted_posts['tags'])){
                            $sorted_posts['tags'][$tag->title] = 1;
                        }else{
                            $sorted_posts['tags'][$tag->title]++;
                        }
                        */

                        //add tag slug + title
                        if(!array_key_exists($tag->slug, $sorted_posts['tags'])){
                            $sorted_posts['tags'][$tag->slug] = $tag->title;
                        }
                    }
                }

                if($major_story){

                    if($featured==0){
                        //first major story is featured
                        $sorted_posts['featured'] = $p;


                        //add story so far
                        $sorted_posts['related'] = array();

                        if(property_exists($p->custom_fields, 'related_posts')){

                            $custom_fields = $p->custom_fields;

                            $related_posts = $custom_fields->related_posts[0];

                            $related = unserialize($related_posts);

                            foreach($related as $r){
                                $sorted_posts['related'][] = $this->getRelated($r);
                            }

                        }

                        $featured = 1;

                    }else{

                        $sorted_posts['major_stories'][] = $p;

                    }


                }else{

                    $sorted_posts['other_stories'][] = $p;

                }
            }
        }

        return $sorted_posts;

    }

    public function getHelpLine(){
        $url = Config::get('custom_config.WPFeedRoot') . "?json=helpdesk/get_helpline";

        $result = json_decode($this->file_get_contents_curl($url));

        return $result->helpline;
    }
    public function getSupportGroup(){
        $url = Config::get('custom_config.WPFeedRoot') . "?json=helpdesk/get_supportgroup";

        $result = json_decode($this->file_get_contents_curl($url));

        return $result->supportgroup;
    }
    public function getSocialMedia(){
        $url = Config::get('custom_config.WPFeedRoot') . "?json=helpdesk/get_socialmedia";

        $result = json_decode($this->file_get_contents_curl($url));

        return $result->socialmedia;
    }


    public function getRelated($id){
        $url = Config::get('custom_config.WPFeedRoot') . "?json=get_post&id=" . $id;


        $result = json_decode($this->file_get_contents_curl($url));

        return $result->post;
    }

    public function filterFeed(){

        if($_GET['tag']!='all'){
            $url = Config::get('custom_config.WPFeedRoot') . "?json=get_tag_posts&tag=" . urlencode($_GET['tag']);

            $result = json_decode($this->file_get_contents_curl($url));

            $finalPosts = $result->posts;
        }else{

            $url = Config::get('custom_config.WPFeedRoot') . "?json=get_category_posts&id=2";

            $result = json_decode($this->file_get_contents_curl($url));

            $posts = $result->posts;

            $finalPosts = array();

            foreach($posts as $p){
                $major_story = false;

                foreach($p->tags as $tag){
                    if($tag->slug == "featured"){
                        $major_story = true;
                    }
                }
                if($major_story!=true){
                    $finalPosts[] = $p;
                }
            }
        }

        foreach($finalPosts as $story){
            print '<div class="story">';
            print '<a href="'.$story->url.'"><h4>'.$story->title.'</h4></a>';
            if(property_exists($story, 'thumbnail')){
                print '<img src="'.$story->thumbnail.'" style="float:left;width:100px">';
            }
            print $story->excerpt.'</p>
                <p class="story-metadata"><i>Written by '.$story->author->nickname.' | Posted on '.date("l jS \of F Y h:i:s A", strtotime($story->date)).'</i></p>
            </div>';
        }

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
