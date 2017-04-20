<?php
error_reporting(E_ALL);
//require_once "hero_stats.php";
//require_once "achievement.php";
class Parser {
  public static function parse($json){
  	$json_data = json_decode($json, true);
  	$return = array(); //Ne pas oublier de retourner TOUTES les valeurs
  	$platform_list = array();
  	$overall_stats = array();
  	$game_stats = array();
  	$average_stats = array();
  	$competitive_hero_stats = array();
  	$quickaplay_hero_stats = array();
  	$hero_stats = array();
  	$playtime = array();
  	$achievements = array();
  	foreach($json_data as $platform => $value){
  		if($platform != "_request" && $platform != "any"){
  			$platform_list[$platform] = true;
  			foreach($value as $request = $val){
  				if($request == "stats"){
  					foreach($val as $mode => $res){
  						foreach($res as $type => $data){
  							foreach($data as $title => $number){
  								switch($type){
  								case "overall_stats":
  									$overall_stats[$mode][$title]=$number;
  									break;
  								case "game_stats":
  									$game_stats[$mode][$title]=$number;
  									break;
  								case "average_stats":
  									$average_stats[$mode][$title]=$number;
  									break;
  								case:"competitive":
  									break;
  								}
  							}
  						}
  					}
  				}
  				else if ($request = "heroes"){
  					foreach($val as $stat_or_playtime => $res){
  						foreach($res as $mode => $name){
  							if($stat_or_playtime == "stats"){
  								if($mode = "quickplay"){
  									foreach($name as $general_or_specific => $data){
  										foreach($data as $title => $number){
  											$quickplay_hero_stats[$name][$general_or_specific]=$number;
  										}
  									}
  								}else{ //Competitive
  									foreach($name as $general_or_specific => $data){
  										foreach($data as $title => $number){
  											$competitive_hero_stats[$name][$general_or_specific]=$number;
  										}
  									}
  								}
  							}else { //Playtime
  								foreach($name as $hero_data => $number){
  									$playtime[$name][$mode] = $number;
  								}
  							}
  						}
  					}
  				}else { //Achievements
  					foreach($val as $type => $var){
  						foreach($var as $title => $bool){
  							$achievements[$title] = $bool;
  						} 
  					}
  				}
  			}
  		}
  	}
  }
  /*  
  public static function parse_achievements($json){
  	$json_data = json_decode($json, true);
  	$achievements = array();
  	foreach($json_data as $key => $value){
  		if($key != "achievements"){
  			echo "$key -> '$value<br/>";
  			$achievements[$key]=$value;
  		}else{
  			$compt = 0;
				$achievement_list = array();
  			foreach($value as $id => $val){
  				$achievement_data = new Achievement();
  				$achievement_data->setName($val["name"]);
  				$achievement_data->setFinished($val["finished"]);
  				$achievement_data->setImage($val["image"]);
  				$achievement_data->setDescription($val["description"]);
  				$achievement_list[$compt] = $achievement_data;
  				$compt=$compt+1;
  				}
  			$achievements['achievements'] = $achievement_list;
  		}
  	}
  	return $achievements;
  }
  
  public static function parse_platforms($json){
  	$json_data = json_decode($json, true);
  	$platform_list=array();
  	foreach($json_data as $key => $value){
  		foreach($value as $id => $val){
  			$platform_list[$val['platform']][$val['region']] = $val['hasAccount'];
  		}
  	}
  	return $platform_list;
  }

	public static function parse_profile($json){
		$json_data = json_decode($json, true);
		$data = array();
		foreach($json_data as $key => $value){
			foreach($value as $id => $val){
				switch($id){
					case $id=="username"||$id=="level"||$id=="avatar"||$id=="levelFrame"||$id=="star":
						$data[$id]=$val;
						break;
					case "games":
						$data['quickplayWins']=$val['quick']['wins'];
						$data['competitiveWins']=$val['competitive']['wins'];
						$data['competitivePlayed']=$val['competitive']['played'];
						$data['competitiveLost']=$val['competitive']['lost'];
						break;
					case "playtime":
						$data["playtimeQuick"]=$val['quick'];
						$data["playtimeCompetitive"]=$val['competitive'];
						break;
					case "competitive":
						$data["rank"]=$val['rank'];
						$data["rank_img"]=$val['rank_img'];
						break;
				}
			}
		}
		return $data;
	}	
	
  
  public static function parse_allHeroes($json){
  	$json_data = json_decode($json, true);
  	$data = array();
  	foreach($json_data as $key => $value){
  		$data[$key] = $value;
  	}
  	var_dump($data);
  	return $data;
  }
  
	public static function parse_hero($json){
		$json_data = json_decode($json, true);
		$heros = array();
		foreach($json_data as $key => $value){
			$heros[$key] = new HeroStats();
			$heros[$key]->setHeroName($key);
			foreach($value as $id => $val){
				$heros[$key]->setValue($id, $val);
			}
		}
		return $heroes;
	}
	
 public static function parse_heroes($json){
 	$json_data = json_decode($json, true);
 	$heroes_data = array();
 	foreach($json_data as $key => $value){
 		foreach($value as $id => $val){
 			switch ($id){
 				case "name":
 					$hero_name = $val;
 					break;
 				case $id=="playtime" || $id=="image"||$id=="percentage":
 				$heroes_data[$hero_name][$id] = $val;
 				break;		
 			}
 		}
 	}
 	return $heroes_data;
 }*/
}
