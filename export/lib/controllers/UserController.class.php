<?php

// Generated by Haxe 3.4.4
class controllers_UserController {
	public function __construct(){}
	static function dispatch($request, $reference) {
		$tmp = null;
		if($reference === null) {
			$tmp = $request->method === "GET";
		} else {
			$tmp = false;
		}
		if($tmp) {
			controllers_UserController::retrieveAll($request);
		} else {
			$tmp1 = null;
			if($request->method !== "POST") {
				$tmp1 = $reference === null;
			} else {
				$tmp1 = false;
			}
			if($tmp1) {
				$request->setReturnCode(406, "Not Acceptable\x0Amissing reference");
			} else {
				switch($request->method) {
				case "DELETE":{
					controllers_UserController::deleteUser($request, $reference);
				}break;
				case "GET":{
					controllers_UserController::retrieveOne($request, $reference);
				}break;
				case "POST":{
					controllers_UserController::postUser($request);
				}break;
				case "PUT":{
					controllers_UserController::updateUser($request, $reference);
				}break;
				default:{
					$request->setReturnCode(501, "Not implement");
				}break;
				}
			}
		}
	}
	static function retrieveAll($request) {
		$elevesInDB = Lambda::harray(models_Eleves::$manager->all(null));
		$request->setHeader("Content-Type", "application/json");
		$request->send(haxe_Json::phpJsonEncode($elevesInDB, null, null));
	}
	static function retrieveOne($request, $idEleve) {
		$request->setHeader("Content-Type", "application/json");
		$user = models_Eleves::$manager->unsafeGet($idEleve, true);
		if($user === null) {
			$request->setReturnCode(404, "Eleve not found for reference " . _hx_string_rec($idEleve, ""));
			return;
		}
		$request->send(haxe_Json::phpJsonEncode($user, null, null));
	}
	static function postUser($request) {
		$data = $request->data;
		$u = null;
		$tmp = null;
		if($data->nom !== null) {
			$tmp = !Std::is($data->nom, _hx_qtype("String"));
		} else {
			$tmp = true;
		}
		if($tmp) {
			$request->setReturnCode(400, "Bad nom");
			return;
		}
		$tmp1 = null;
		if($data->prenom !== null) {
			$tmp1 = !Std::is($data->prenom, _hx_qtype("String"));
		} else {
			$tmp1 = true;
		}
		if($tmp1) {
			$request->setReturnCode(400, "Bad nom");
			return;
		}
		$tmp2 = null;
		if($data->mail !== null) {
			$tmp2 = !Std::is($data->mail, _hx_qtype("String"));
		} else {
			$tmp2 = true;
		}
		if($tmp2) {
			$request->setReturnCode(400, "Bad mail");
			return;
		}
		$tmp3 = null;
		if($data->telephone !== null) {
			$tmp3 = !Std::is($data->telephone, _hx_qtype("String"));
		} else {
			$tmp3 = true;
		}
		if($tmp3) {
			$request->setReturnCode(400, "Bad telephone");
			return;
		}
		$tmp4 = null;
		if($data->mdp !== null) {
			$tmp4 = !Std::is($data->mdp, _hx_qtype("String"));
		} else {
			$tmp4 = true;
		}
		if($tmp4) {
			$request->setReturnCode(400, "Bad mdp");
			return;
		}
		$u = new models_Eleves($data->nom, $data->prenom, $data->mail, $data->telephone, $data->mdp);
		$u->insert();
		$request->setHeader("Content-Type", "application/json");
		$request->send("{\"reference\":" . _hx_string_rec($u->idEleves, "") . "}");
	}
	static function updateUser($request, $idEleve) {
		$data = $request->data;
		$u = models_Eleves::$manager->unsafeGet($idEleve, true);
		if($u === null) {
			$request->setReturnCode(404, "Eleve not found");
			return;
		}
		$tmp = null;
		if($data->nom !== null) {
			$tmp = !Std::is($data->nom, _hx_qtype("String"));
		} else {
			$tmp = true;
		}
		if($tmp) {
			$request->setReturnCode(400, "Bad nom");
			return;
		}
		$u->nom = $data->nom;
		$tmp1 = null;
		if($data->prenom !== null) {
			$tmp1 = !Std::is($data->prenom, _hx_qtype("String"));
		} else {
			$tmp1 = true;
		}
		if($tmp1) {
			$request->setReturnCode(400, "Bad prenom");
			return;
		}
		$u->prenom = $data->prenom;
		$tmp2 = null;
		if($data->mail !== null) {
			$tmp2 = !Std::is($data->mail, _hx_qtype("String"));
		} else {
			$tmp2 = true;
		}
		if($tmp2) {
			$request->setReturnCode(400, "Bad mail");
			return;
		}
		$u->mail = $data->mail;
		$tmp3 = null;
		if($data->telephone !== null) {
			$tmp3 = !Std::is($data->telephone, _hx_qtype("String"));
		} else {
			$tmp3 = true;
		}
		if($tmp3) {
			$request->setReturnCode(400, "Bad telephone");
			return;
		}
		$u->telephone = $data->telephone;
		$tmp4 = null;
		if($data->mdp !== null) {
			$tmp4 = !Std::is($data->mdp, _hx_qtype("String"));
		} else {
			$tmp4 = true;
		}
		if($tmp4) {
			$request->setReturnCode(400, "Bad mdp");
			return;
		}
		$u->mdp = $data->mdp;
		$u->update();
	}
	static function deleteUser($request, $idEleve) {
		$u = models_Eleves::$manager->unsafeGet($idEleve, true);
		if($u === null) {
			$request->setReturnCode(404, "Eleve not found");
			return;
		}
		$u->delete();
	}
	function __toString() { return 'controllers.UserController'; }
}
