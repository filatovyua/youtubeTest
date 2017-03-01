<?php
namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;

class AppModel extends Model{
    
    /**
     * My secret code. 
     * @var type 
     */
    protected $API_KEY = "GOOGLE API KEY FOR DEVELOPERS";
    
    public $maxResults = 50;
    public function getMaxResults(){
        return $this->maxResults;
    }
    public function setMaxResults(Integer $number){
        $this->maxResults = $number;
        return self;
    }

    public function __construct() {
        
    }
    
    private function getChannelsIDs($channels){
        $ids = [];
        if (empty($channels))
            return $ids;
        foreach ($channels->getItems() as $item) {
            $ids[] = $item->id;
        }
        return join(",", $ids);
    }
    
    private function getVideoIds($videos){
        $video_ids = [];
        if (empty($videos))
            return $videos;
        foreach ($videos->getItems() as $item) {
            if ($item->id->videoId)
                $video_ids[] = $item->id->videoId;
        }
        return join(",",$video_ids);
    }
    
    private function getVideosArray($detales){
        $response = [];
        if (empty($detales))
            return [];
        foreach ($detales->getItems() as $item) {
            $response[] = [
                "title"=>$item->snippet->title,
                "description"=>$item->snippet->description
                ];
        }
        return $response;
    }


    public function getUserProfile($username){
        if (!$username)
            return NULL;
        $client = new \Google_Client();
        $client->setDeveloperKey($this->API_KEY);
        
        $youtube = new \Google_Service_YouTube($client);
        try{            
            $channels = $youtube->channels->listChannels('snippet', [
                'forUsername' => $username,
                'maxResults' => $this->maxResults
            ]); 
            $ids = $this->getChannelsIDs($channels);
            if (!$ids)
                return [];
            $videos = $youtube->search->listSearch('snippet',[
                "channelId"=>$ids,
                'maxResults' => $this->maxResults,
            ]);   
            $video_ids = $this->getVideoIds($videos);            
            $video_detales = $youtube->videos->listVideos('snippet,contentDetails',[
                "id"=>$video_ids,
                'maxResults' => $this->maxResults
            ]);
            return $this->getVideosArray($video_detales);

        } catch (\Google_Service_Exception $ex) {
            //work google service exception
            return [];
        } catch(\Google_Exception $ex){ 
            //work google exception
            return $ex;
        } catch (Exception $ex){
            //work some other exception
            return $ex;
        }

    }
}
