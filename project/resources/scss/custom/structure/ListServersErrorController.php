<?php

namespace App\Http\Controllers\Admin\Data\api\server;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use simplehtmldom\HtmlDocument;
use simplehtmldom\HtmlWeb;
use App\Models\Episodes;
use App\Models\Servers;
use App\Models\Servers_En;
use App\Models\Tv_Shows;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use Curl\Curl;
use App\MyClass\MyFunction;
use App\MyClass\ApiSimo;

class ListServersErrorController extends Controller
{

    public function Servers_saves($servers, $server, $server_en, $episode, $episodes)
    {
        $msg = "It has not been added or found with us";

         $check = $server->where('domain', $episode->domain)->where('link', $episode->link)->first() ;
         $check_en = $server_en->where('domain', $episode->domain)->where('link', $episode->link)->first() ;

         if (isset($check->data) && isset($check_en->data)) {

           $episode->statut = "finish";
           $episode->save();
         }else {
           if (count($servers) > 0) {
                   if ($check && $check_en) {
                 $server->statut = "finish";
                 $server->data   = json_encode($servers["normale"]);
                 $episode->servers()->save($server);
                 // save Servers encodes
                 $server_en = $server->replicate();
                 $server_en->data = json_encode($servers["encodes"]);
                 $server_en->id = $server->id;
                 $server_en->setTable('servers_encodes');
                 $server_en->save();
                 $msg = "It has been successfully added";

                 // else {
                 //   return collect(["data" =>$check->toArray() ,"data_encodes" =>$check_en->toArray()]) ;
                 // }
                 $episode->statut = "finish";
                 $episode->save();
             } else {
                 //  server datat error
                 $episode->statut = "error";
                 $episode->save();
             }

             }
         }
        return  view("Admin.Apidata.ServerErrorRun", ["msg" => $msg, "datatv" => $servers, "data_tv" => $episode, "Tv_Shows" => $episodes]);
    }
    /// server Animetak :
    public function Animetak(Request $request)
    {
        $api = new ApiSimo;
        $curl = new Curl;
        $client = new HtmlDocument;
        $Episodes = (new Episodes)->where('statut', 'error')->where('domain', "animetak")->paginate(1);
        $list = new Servers;
        $list_en = new Servers_En;
        $episode = $Episodes->first();
        $domain_name = str_ireplace("animetak/", "https://animetak.net/", $episode->link);
        $url = str_replace('/episodes/','/watch_episodes/',$domain_name);
        $url = str_ireplace("id=", "?id=", $url);
        $check = $list
            ->where('domain', $episode->domain)
            ->where('link', $episode->link)
            ->first();
        $check_en = $list_en
            ->where('domain', $episode->domain)
            ->where('link', $episode->link)
            ->first();
    $servers = [];

        if ($episode->statut === 'error' && !isset($check->data) && !isset($check_en->data)) {
            // start preaper data
            $html_body = $curl->get($url);
            $body_player = $client->load($html_body)->find('ul[id=list-serv] li');
            $body_downloads = $client->load($html_body)->find('div[class=downs] ul li a');
            $postId = $api->get_search($html_body, 'postID = "', '"');


            if (count($body_player) > 0) {
                // search list players
                foreach ($body_player as $key_player => $player) {
                    $server_name = $player->find('a[class=server]', 0)->plaintext;
                    $quality = $api->quality($server_name);
                    $server_body = $curl->post("https://animetak.net/ajax/getPlayer", array(
                        'server' => $server_name,
                        'postID' => $postId,
                        'Ajax' => 1,
                    ));
                  $server_body = str_replace("IFRAME","iframe",$server_body);
                  $server_body = str_replace("SRC","src",$server_body);
                  $server_body = str_replace("'",'"',$server_body);
                  $client = new HtmlDocument;
                  $server_link = $api->get_search($server_body,'src="','"');
                  // $server_link = $client->load($server_body)->find('iframe', 0) ;
                    if (isset($server_link)) {
                      //  $server_link = $server_link->src;
                        $servers["normale"]["players"][] = ["name" => $server_name, "link" => $server_link, "quality" => $quality];
                        $servers["encodes"]["players"][] = ["name" => $server_name, "link" => $api->encrypt($server_link), "quality" => $quality];
                    }
                }
            }

            if (count($body_downloads) > 0) {
                // search list downloads
                foreach ($body_downloads as $key_down => $down) {
                    $server_name = $down->plaintext;
                    $server_link = $down->href;
                    $quality = $api->quality($server_name);
                    if (isset($server_link)) {
                        $servers["normale"]["downloads"][] = ["name" => $server_name, "link" => $server_link, "quality" => $quality];
                        $servers["encodes"]["downloads"][] = ["name" => $server_name, "link" => $api->encrypt($server_link), "quality" => $quality];
                    }
                }
            }
            // check episode data sever



            //end check episode data sever
        }
        // end check server database

            return $this->Servers_saves($servers, $list, $list_en, $episode, $Episodes);
    }



    // servers egyanime
    public function Egyanime(Request $request)
    {
        $api = new ApiSimo;
        $curl = new Curl;
        $servers = [];
        $client = new HtmlDocument;
        $Episodes = (new Episodes)->where('statut', 'error')->where('domain', "egyanime")->paginate(1);
        $list = new Servers;
        $list_en = new Servers_En;
        $episode = $Episodes->first();
        $url = str_ireplace("egyanime/watch", "https://www.egyanime.com/watch?", $episode->link);
        $url = str_ireplace("?id=", "&ivd=", $url);
        $check = $list
            ->where('domain', $episode->domain)
            ->where('link', $episode->link)
            ->first();
        $check_en = $list_en
            ->where('domain', $episode->domain)
            ->where('link', $episode->link)
            ->first();
        if ($episode->statut === 'error' && !isset($check->data) && !isset($check_en->data)) {
            // start preaper data

            $html_body = $curl->get(str_replace('?id=', '&id=', $url));
            $body_player = $client->load($html_body)->find('div[id=server-watch] a');
            $body_downloads = $client->load($html_body)->find('div[id=server-download] div[id=result] a');


            if (count($body_player) > 0) {
                // search list players
                foreach ($body_player as $key_player => $player) {
                    $server_name = $api->filterOnly($player->plaintext);
                    $quality = $api->quality($server_name);
                    $server_link = $player->{"data-link"};
                    if (isset($server_link)) {
                        $servers["normale"]["players"][] = ["name" => $server_name, "link" => $server_link, "quality" => $quality];
                        $servers["encodes"]["players"][] = ["name" => $server_name, "link" => $api->encrypt($server_link), "quality" => $quality];
                    }
                }
            }

            if (count($body_downloads) > 0) {
                // search list downloads
                foreach ($body_downloads as $key_down => $down) {
                    $server_name = $down->plaintext;
                    $server_link = $down->href;
                    $quality = $api->quality($server_name);
                    if (isset($server_link)) {
                        $servers["normale"]["downloads"][] = ["name" => $server_name, "link" => $server_link, "quality" => $quality];
                        $servers["encodes"]["downloads"][] = ["name" => $server_name, "link" => $api->encrypt($server_link), "quality" => $quality];
                    }
                }
            }

            // check episode data sever


            //end check episode data sever
        }
        // end check server database

                  return $this->Servers_saves($servers, $list, $list_en, $episode, $Episodes);
    }

    // servers Anime4up
    public function Anime4up(Request $request)
    {
        $api = new ApiSimo;
        $curl = new Curl;
        $client = new HtmlDocument;
        $Episodes = (new Episodes)->where('statut', 'error')->where('domain', "anime4up")->paginate(1);
        $list = new Servers;
        $servers = [];
        $list_en = new Servers_En;
        $episode = $Episodes->first();
        $url = str_ireplace("anime4up/", "https://ww.anime4up.com/", $episode->link);
        $url = str_ireplace("id=", "?id=", $url);
        $check = $list
            ->where('domain', $episode->domain)
            ->where('link', $episode->link)
            ->first();
        $check_en = $list_en
            ->where('domain', $episode->domain)
            ->where('link', $episode->link)
            ->first();

        //if ($episode->statut === 'starts' && !isset($check->data) && !isset($check_en->data)) {
      if ($episode->statut === 'error' && !isset($check->data) && !isset($check_en->data)) {
            // start preaper data

            $html_body = $curl->get($url);
            $body_player = $client->load($html_body)->find('ul[id=episode-servers] li a');
            $body_downloads = $client->load($html_body)->find('div[id=download_انميفوراب1] div[class=col-md-6]');

            if (count($body_player) > 0) {
                // search list players
                foreach ($body_player as $key_player => $player) {
                    $server_name = $api->filterOnly($player->plaintext);
                    $quality = $api->quality($server_name);
                    $server_link = $player->{"data-ep-url"};
                    if (isset($server_link)) {
                        $servers["normale"]["players"][] = ["name" => $server_name, "link" => $server_link, "quality" => $quality];
                        $servers["encodes"]["players"][] = ["name" => $server_name, "link" => $api->encrypt($server_link), "quality" => $quality];
                    }
                }
            }

            if (count($body_downloads) > 0) {
                // search list downloads
                foreach ($body_downloads as $key_down => $down) {
                    $quality_check = $down->find('ul[class=quality-list] li', 0)->plaintext;
                    $quality = $api->quality($quality_check);
                    $quality_links = $down->find('ul[class=quality-list] li a');
                    foreach ($quality_links as $key => $value) {
                        $server_name = $value->plaintext;
                        $server_link = $value->href;
                        if (isset($server_link)) {
                            $servers["normale"]["downloads"][] = ["name" => $server_name, "link" => $server_link, "quality" => $quality];
                            $servers["encodes"]["downloads"][] = ["name" => $server_name, "link" => $api->encrypt($server_link), "quality" => $quality];
                        }
                    }
                }
            }
        // check episode data sever
        }
        // end check server database

        return $this->Servers_saves($servers, $list, $list_en, $episode, $Episodes);
        //end check episode data sever
    }

    // servers shahid4u_anime
    public function shahid4u_anime(Request $request)
    {
        $api = new ApiSimo;
        $curl = new Curl;
        $curl->setHeader('x-requested-with', "XMLHttpRequest");
        $client = new HtmlDocument;
        $Episodes = (new Episodes)->where('statut', 'error')->where('domain', "shahid4u_anime")->paginate(1);
        $list = new Servers;
        $list_en = new Servers_En;
        $servers = [];
        $episode = $Episodes->first();
        $url_raw = str_ireplace("shahid4u_anime/", "https://shahid4u.onl/", $episode->link);
        $url_raw = str_ireplace("id=", "?id=", $url_raw);
        $url_raw    = parse_url($url_raw);
        $url = explode('/', trim($url_raw['path'], '/'));
        $link_watch = "https://shahid4u.onl/watch/" . $url[1];

        $check = $list
            ->where('domain', $episode->domain)
            ->where('link', $episode->link)
            ->first();
        $check_en = $list_en
            ->where('domain', $episode->domain)
            ->where('link', $episode->link)
            ->first();

        if ($episode->statut === 'error' && !isset($check->data) && !isset($check_en->data)) {


            // start preaper data

            $html_watch_body = $curl->get($link_watch);

            $servers = [];
            if (isset($html_watch_body->message)) {
              $body_player = [];
              $post_id = 0;
            }else {
            $body_player = $client->load($html_watch_body)->find('ul[class=servers-list] li');
            $post_id = $api->get_search($html_watch_body, '&_post_id=', '"');



            if (strlen($post_id) == 0) {
            $post_id = $curl->get(str_replace('watch', 'download', $link_watch));
            $post_id = $api->get_search($post_id, 'postId:"', '"');
            }
            $body_downloads0 = $curl->get("https://shahid4u.onl/ajaxCenter?_action=getdownloadlinks&postId=" . $post_id);
            $body_downloads = $client->load($body_downloads0)->find('div[class=DownloadDiv] a');
            if (count($body_downloads) == 0) {
            $body_downloads = $client->load(str_replace('download-btns download-media', 'download_simo', $body_downloads0))->find('div[class=download_simo] a');
            }

            //$server_link = $api->get_search($server_body,'src="','"');



            if (count($body_player) > 0) {
                // search list players
                foreach ($body_player as $key_player => $player) {
                    $server_name = $api->filterOnly($player->plaintext);
                    $quality = $api->quality($server_name);

                    if (strlen($player->{"data-embedd"}) < 10) {
                      $server_body = $curl->get("https://shahid4u.onl/ajaxCenter?_action=getserver&_post_id=" . $post_id, array(
                          'serverid' => $player->{"data-embedd"},
                      ));
                      $server_link = trim($server_body);
                    }else {
                      $server_link = $player->{"data-embedd"};
                    }

                    if (isset($server_link)) {
                        $servers["normale"]["players"][] = ["name" => $server_name, "link" => $server_link, "quality" => $quality];
                        $servers["encodes"]["players"][] = ["name" => $server_name, "link" => $api->encrypt($server_link), "quality" => $quality];
                    }
                }
            }


            if (count($body_downloads) > 0) {
                // search list downloads
                foreach ($body_downloads as $key_down => $down) {


                    if (count($down->find("span[class=name]")) > 0) {
                    $server_name = $down->find("span[class=name]", 0)->plaintext;
                    $quality = $api->quality($down->find("span[class=quality]", 0)->plaintext);
                  }else {
                    $server_name = $down->plaintext;
                    $quality = $api->quality($server_name);
                  }
                    $server_link = $down->href;



                    if (isset($server_link)) {
                        $servers["normale"]["downloads"][] = ["name" => $server_name, "link" => $server_link, "quality" => $quality];
                        $servers["encodes"]["downloads"][] = ["name" => $server_name, "link" => $api->encrypt($server_link), "quality" => $quality];
                    }
                }
            }



        }  }
        // end check server database
        // check episode data sever

        return $this->Servers_saves($servers, $list, $list_en, $episode, $Episodes);
        //end check episode data sever
    }


    // servers egyanime
    public function Okanime(Request $request)
    {
        $api = new ApiSimo;
        $curl = new Curl;
        $client = new HtmlDocument;
        $Episodes = (new Episodes)->where('statut', 'error')->where('domain', "okanime")->paginate(1);
        $list = new Servers;
        $list_en = new Servers_En;
        $episode = $Episodes->first();

        $servers = [];
        $url = str_ireplace("okanime/", "https://okanime.tv/", $episode->link);
        $url = str_ireplace("id=", "?id=", $url);

        $check = $list
            ->where('domain', $episode->domain)
            ->where('link', $episode->link)
            ->first();
        $check_en = $list_en
            ->where('domain', $episode->domain)
            ->where('link', $episode->link)
            ->first();

        //  if ($episode->statut === 'error' && !isset($check->data) && !isset($check_en->data)) {
        if ($episode->statut === 'error' && !isset($check->data) && !isset($check_en->data)) {
            // start preaper data
            $html_body = $curl->get($url);
            $body_player = $client->load($html_body)->find('div[class=batnie-scroll] div[data-vip=false]');
            $body_downloads = $client->load($html_body)->find('div[class=batnie-scroll] a');


            if (count($body_player) > 0) {
                // search list players
                foreach ($body_player as $key_player => $player) {

                    $server_name = $api->filterOnly($player->{"data-provider_name"});
                    $quality = $api->quality($player->find("small", 0)->plaintext);
                    $server_link_html = $curl->get('https://okanime.tv' . $player->{"data-href"});
                    // okanime file get
                    if (isset($server_link_html->data->attributes->url)) {
                        $server_link = $server_link_html->data->attributes->url;
                        if (strpos($server_link, "okanime.tv")) {
                            $html_body_url_body = str_replace("\n", '', $server_link_html->data->attributes->url);
                            $curl->setReferrer('http://www.okanime.tv');
                            $server_link = $api->get_search($curl->get($html_body_url_body), "src = '", "'");
                        }
                        $servers["normale"]["players"][] = ["name" => $server_name, "link" => $server_link, "quality" => $quality];
                        $servers["encodes"]["players"][] = ["name" => $server_name, "link" => $api->encrypt($server_link), "quality" => $quality];
                    }
                    //  end okanime file get
                }
            }

            if (count($body_downloads) > 0) {
                // search list downloads
                foreach ($body_downloads as $key_down => $down) {

                    $server_name = $down->find("span", 0)->plaintext;
                    $server_link = $down->href;
                    $quality = $api->quality($down->find("small", 0)->plaintext);
                    if (isset($server_link)) {
                        $servers["normale"]["downloads"][] = ["name" => $server_name, "link" => $server_link, "quality" => $quality];
                        $servers["encodes"]["downloads"][] = ["name" => $server_name, "link" => $api->encrypt($server_link), "quality" => $quality];
                    }
                }
            }

            // check episode data sever

        }
        // end check server database
        return $this->Servers_saves($servers, $list, $list_en, $episode, $Episodes);
        //end check episode data sever
    }

    // servers egyanime
    public function Gateanime(Request $request)
    {
        $api = new ApiSimo;
        $curl = new Curl;
        $servers = [];
        $client = new HtmlDocument;
        $Episodes = (new Episodes)->where('statut', 'error')->where('domain', "gateanime")->paginate(1);
        $list = new Servers;
        $list_en = new Servers_En;
        $episode = $Episodes->first();
        $url = str_ireplace("gateanime/", "https://gateanime.com/", $episode->link);
        $url = str_ireplace("id=", "?id=", $url);
        $check = $list
            ->where('domain', $episode->domain)
            ->where('link', $episode->link)
            ->first();
        $check_en = $list_en
            ->where('domain', $episode->domain)
            ->where('link', $episode->link)
            ->first();
        // $response = Http::get($url);
        // dd($response->body());
        $curl->setReferrer('https://www.google.com');
        $curl->setUserAgent("Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36");

        //if ($episode->statut === 'error' && !isset($check->data) && !isset($check_en->data)) {
         if ($episode->statut === 'error' && !isset($check->data) && !isset($check_en->data)) {
            // start preaper data

            $html_body = $curl->get($url);
            $html_body = $client->load($html_body)->find('div[class=TpRwCont] main', 0);
            $body_player = $client->load(html_entity_decode($html_body))->find('ul[class=TPlayerNv] li');
            $body_iframe = $client->load(html_entity_decode($html_body))->find('div[class=TPlayer]', 0);
            $body_downloads = $client->load($html_body)->find('div[class=TPTblCn] tbody tr');



            if (count($body_player) > 0) {
                // search list players
                foreach ($body_player as $key_player => $player) {
                    $client = new HtmlDocument;
                    $id = $player->{"data-tplayernv"};
                    $server_link_body = $body_iframe->find('div[id=' . $id . ']', 0)->find('iframe', 0)->src;
                    $server_link = $client->load($curl->get($server_link_body))->find('iframe', 0)->src;
                    $server_name = $api->filterOnly($player->plaintext);


                    $quality = $api->quality($server_name);

                    if (isset($server_link)) {
                        $servers["normale"]["players"][] = ["name" => $server_name, "link" => $server_link, "quality" => $quality];
                        $servers["encodes"]["players"][] = ["name" => $server_name, "link" => $api->encrypt($server_link), "quality" => $quality];
                    }
                }
            }

            if (count($body_downloads) > 0) {
                // search list downloads
                foreach ($body_downloads as $key_down => $down) {
                    $url_link = $down->find('td a', 0)->href;
                    $server_link = $down->find('td a', 0)->href;
                    $server_link_body = $curl->get($server_link);
                    if (isset($curl->responseHeaders['location'])) {
                        $server_link = $curl->responseHeaders['location'];
                        $url_link = explode(".", str_replace("//", "", strstr($server_link, '//')));
                        $server_name = ucwords(strpos($server_link, "w.") ? $url_link[1] : $url_link[0]);
                        $quality = $api->quality($down->find('span', 2)->plaintext);
                        $servers["normale"]["downloads"][] = ["name" => $server_name, "link" => $server_link, "quality" => $quality];
                        $servers["encodes"]["downloads"][] = ["name" => $server_name, "link" => $api->encrypt($server_link), "quality" => $quality];
                    }
                    //end check link
                }
            }

            // check episode data sever

        }
        // end check server database
        return $this->Servers_saves($servers, $list, $list_en, $episode, $Episodes);
        //end check episode data sever
    }


    // servers egyanime
    public function xsanime(Request $request)
    {
        $api = new ApiSimo;
        $curl = new Curl;
        $servers = [];
        $client = new HtmlDocument;
        $Episodes = (new Episodes)->where('statut', 'error')->where('domain', "xsanime")->paginate(1);
        $list = new Servers;
        $list_en = new Servers_En;
        $episode = $Episodes->first();
        $url = str_ireplace("xsanime/", "https://ww.xsanime.com/", $episode->link);
        $url = str_ireplace("id=", "?id=", $url);
        $check = $list
            ->where('domain', $episode->domain)
            ->where('link', $episode->link)
            ->first();
        $check_en = $list_en
            ->where('domain', $episode->domain)
            ->where('link', $episode->link)
            ->first();

        //  if ($episode->statut === 'error' && !isset($check->data) && !isset($check_en->data)) {
        if ($episode->statut === 'error' && !isset($check->data) && !isset($check_en->data)) {
            // start preaper data

            $html_body = $curl->get($url);
            $body_player = $client->load($html_body)->find('ul[class=WatchServers] li');
            $body_downloads = $client->load($html_body)->find('div[id=DownloadTable] ul');
            $id = $api->get_search($html_body, "post:'", "'");

            if (count($body_player) > 0) {
                // search list players
                foreach ($body_player as $key_player => $player) {
                    $server_name = $player->plaintext;
                    $quality = $api->quality($server_name);

                    $server_body = $curl->post("https://ww.xsanime.com/wp-admin/admin-ajax.php", array(
                        'i' => $player->{"data-i"},
                        'post' => $id,
                        'action' => "GetServer",
                    ));

                    $client = new HtmlDocument;
                    $server_links = $client->load($server_body)->find('iframe', 0);
                    $server_link = $server_links->src ?? $player->{"data-server"};


                    if (strlen($server_link) > 0) {
                        $servers["normale"]["players"][] = ["name" => $server_name, "link" => $server_link, "quality" => $quality];
                        $servers["encodes"]["players"][] = ["name" => $server_name, "link" => $api->encrypt($server_link), "quality" => $quality];
                    }
                }
            }

            if (count($body_downloads) > 0) {
                // search list downloads
                foreach ($body_downloads as $key_down => $down) {
                    $server_name = $down->find("li", 0)->plaintext;
                    $server_link = $down->find("li a", 0)->href;
                    $quality = $api->quality($server_name);
                    if (isset($server_link)) {
                        $servers["normale"]["downloads"][] = ["name" => $server_name, "link" => $server_link, "quality" => $quality];
                        $servers["encodes"]["downloads"][] = ["name" => $server_name, "link" => $api->encrypt($server_link), "quality" => $quality];
                    }
                }
            }

            // check episode data sever

        }
        // end check server database
        return $this->Servers_saves($servers, $list, $list_en, $episode, $Episodes);
        //end check episode data sever
    }
}
