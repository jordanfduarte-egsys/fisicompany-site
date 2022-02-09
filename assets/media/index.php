<?php
if(!isset($_FILES))exit;

include('m2brimagem.php');	
/**
 * array(
 * 		[0] =array(
 * 					'altura'=>1024,
 * 					'largura'=>800,
 * 					 'pasta'=>'thumb',
 * 					'opcao'=>'crop' corta a imgem
 * 					'dir'=>'banner'
 * 				 	)
 * 		[1]=array(
 * 					'altura'=>1024,
 * 					'largura'=>800,
 * 					 'pasta'=>'thumb2',
 * 					'opcao'=>'fill' imagem com acrecimo de um filete
 * 					'dir'=>'banner'
 * 				 	)
 * 		[2]=array(
 * 					'altura'=>1024,
 * 					'largura'=>800,
 * 					 'pasta'=>'thumb3',
 * 					'opcao'=>'normal'//normal nao redimenciona
 ** 					'dir'=>'banner' 
 * 				 	)
 * 
 * )
 * 
 */
 
if(!is_array($_FILES["myfile"]["name"])) //single file
{
	$fileNameExplode = $_FILES['myfile']['name'];
	$fileNameExplode = explode(".",$fileNameExplode);
	$fileNameExplode = end($fileNameExplode);
	$extencao = strtolower($fileNameExplode);
	
	if($extencao == "png") //Somente png
	{
		$imagem = array();
		$fileName = $_FILES["myfile"]["name"];//Original name
		$fileNameMd5 = md5($fileName.time()).".".$extencao;//Nome md5		
		if(!is_dir($_REQUEST['dir']."/"))
					mkdir($_REQUEST['dir']."/", 0755);//Se não existir a pasta
		if(move_uploaded_file($_FILES["myfile"]["tmp_name"],$_REQUEST['dir']."/".$fileNameMd5)){
					
			foreach($_REQUEST as $i => $imagem)//foreach das configuraçãoes de uma imgem
			{
				if(!is_array($imagem))
					continue;
				$imagem['destino'] = $_REQUEST['dir']."/".($imagem['pasta'] == "" ? "" : $imagem['pasta']."/");				
				if(!is_dir($imagem['dir']))
						mkdir($imagem['dir'], 0755);
				chmod($imagem['destino'], 0777);//Da permissao a pasta destinataria	
				$img = imagecreatefrompng($_REQUEST['dir']."/".$fileNameMd5);
				$largura = $imagem['largura'];
				$altura = $imagem['altura'];
				$x = imagesx($img);
				$y = imagesy($img);			
				$altura = ($largura*$y) / $x;
				$nova = imagecreatetruecolor($largura, $altura);
				imagealphablending ($nova, true);
				$transparente = imagecolorallocatealpha ($nova, 0, 0, 0, 127);
				imagefill ($nova, 0, 0, $transparente);
				imagecopyresampled($nova, $img, 0, 0, 0, 0, $largura, $altura, $x, $y);
				imagesavealpha($nova, true);
				imagepng($nova, $imagem['destino'].$fileNameMd5);
				imagedestroy($img);
				imagedestroy($nova);			
					
			}
			echo json_encode(array("status"=>true,"arquivo"=>$fileNameMd5));
			exit;
		}else{
			echo json_encode(array("status"=>false,"exception"=>"Ops! Falha ao mover o arquivo."));
			exit;
		}
		
	}else if ($extencao == "jpg" or $extencao == "gif" or $extencao == "jpeg") //faz uploade de imagem destes formatos
	{
		
		$imagem = array();
		$fileName = $_FILES["myfile"]["name"];//Original name
		$fileNameMd5 = md5($fileName.time()).".".$extencao;//Nome md5		
		if(!is_dir($_REQUEST['dir']."/"))
					mkdir($_REQUEST['dir']."/", 0755);	
		
		if(move_uploaded_file($_FILES["myfile"]["tmp_name"],$_REQUEST['dir']."/".$fileNameMd5)){
				
			foreach($_REQUEST as $i => $imagem)//foreach das configuraçãoes de uma imgem
			{
				if(!is_array($imagem))
					continue;
				$imagem['destino'] = $_REQUEST['dir']."/".($imagem['pasta'] == "" ? "" : $imagem['pasta']."/");				
				if(!is_dir($imagem['dir']))
					mkdir($imagem['dir'], 0755);
				
				chmod($imagem['destino'], 0777);//Da permissao a pasta destinataria				
				$oImg = new m2brimagem();//cria objeto
				$oImg->carrega($imagem['dir']."/".$fileNameMd5);//				
				$valida = $oImg->valida();
				if ($valida == 'OK') {
					if($imagem['opcao'] == "crop")				
							$oImg->redimensiona($imagem['largura'],$imagem['altura'],'crop');
					else if($imagem['opcao'] == "fill")
							$oImg->redimensiona($imagem['largura'],$imagem['altura'],'fill');
					else if($imagem['opcao'] == "largura")
							$oImg->redimensiona($imagem['largura'],0);
					else if($imagem['opcao'] == "altura")
							$oImg->redimensiona(0, $imagem['altura']);
										
					$oImg->grava($imagem['destino'].$fileNameMd5,100);	//Grava a imagem no destino
				}				
			}	
			echo json_encode(array("status"=>true,"arquivo"=>$fileNameMd5));
			exit;
		}else
		{
			echo json_encode(array("status"=>false,"exception"=>"Ops! Falha ao mover o arquivo."));
			exit;
		}
	}else
	{
		echo json_encode(array("status"=>false,"exception"=>"Ops! Formato de imagem não avaliado."));
		exit;
	}	
	 	
}else//Multiple files, file[]
{
  $arrValida = Array();
  $fileCount = count($_FILES["myfile"]["name"]);
  for($i=0; $i < $fileCount; $i++)
  {
	 	$extencao = strtolower(end(explode("/",$_FILES['myfile']['name'][$i])));
		if($extencao == "png") //Somente png
		{
			
				$imagem = array();
				$fileName = $_FILES["myfile"]["name"][$i];//Original name
				$fileNameMd5 = md5($fileName.time()).".".$extencao;//Nome md5		
				if(!is_dir($_REQUEST['dir']."/"))
							mkdir($_REQUEST['dir']."/", 0755);//Se não existir a pasta
				if(move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$_REQUEST['dir']."/".$fileNameMd5)){					
					foreach($_REQUEST as $i => $imagem)//foreach das configuraçãoes de uma imgem
					{
						if(!is_array($imagem))
							continue;
						$imagem['destino'] = $_REQUEST['dir']."/".($imagem['pasta'] == "" ? "" : $imagem['pasta']."/");				
						if(!is_dir($imagem['dir']))
								mkdir($imagem['dir'], 0755);
						chmod($imagem['destino'], 0777);//Da permissao a pasta destinataria	
						$img = imagecreatefrompng($_REQUEST['dir']."/".$fileNameMd5);
						$largura = $imagem['largura'];
						$altura = $imagem['altura'];
						$x = imagesx($img);
						$y = imagesy($img);			
						$altura = ($largura*$y) / $x;
						$nova = imagecreatetruecolor($largura, $altura);
						imagealphablending ($nova, true);
						$transparente = imagecolorallocatealpha ($nova, 0, 0, 0, 127);
						imagefill ($nova, 0, 0, $transparente);
						imagecopyresampled($nova, $img, 0, 0, 0, 0, $largura, $altura, $x, $y);
						imagesavealpha($nova, true);
						imagepng($nova, $imagem['destino'].$fileNameMd5);
						imagedestroy($img);
						imagedestroy($nova);			
							
					}
					echo json_encode(array("status"=>true,"arquivo"=>$fileNameMd5));
					exit;
				}else{
					echo json_encode(array("status"=>false,"exception"=>"Ops! Falha ao mover o arquivo."));
					exit;
				}
				
			
		}else if ($extencao == "jpg" or $extencao == "gif" or $extencao == "jpeg") //faz uploade de imagem destes formatos
		{
			$imagem = array();
			$fileName = $_FILES["myfile"]["name"][$i];//Original name
			$fileNameMd5 = md5($fileName.time()).".".$extencao;//Nome md5		
			if(!is_dir($_REQUEST['dir']."/"))
						mkdir($_REQUEST['dir']."/", 0755);	
			
			if(move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$_REQUEST['dir']."/".$fileNameMd5)){
					
				foreach($_REQUEST as $i => $imagem)//foreach das configuraçãoes de uma imgem
				{
					if(!is_array($imagem))
						continue;
					$imagem['destino'] = $_REQUEST['dir']."/".($imagem['pasta'] == "" ? "" : $imagem['pasta']."/");				
					if(!is_dir($imagem['dir']))
						mkdir($imagem['dir'], 0755);
					
					chmod($imagem['destino'], 0777);//Da permissao a pasta destinataria				
					$oImg = new m2brimagem();//cria objeto
					$oImg->carrega($imagem['dir']."/".$fileNameMd5);//				
					$valida = $oImg->valida();
					if ($valida == 'OK') {
						if($imagem['opcao'] == "crop")				
								$oImg->redimensiona($imagem['largura'],$imagem['altura'],'crop');
						else if($imagem['opcao'] == "fill")
								$oImg->redimensiona($imagem['largura'],$imagem['altura'],'fill');
						else if($imagem['opcao'] == "largura")
								$oImg->redimensiona($imagem['largura'],0);
						else if($imagem['opcao'] == "altura")
								$oImg->redimensiona(0, $imagem['altura']);
											
						$oImg->grava($imagem['destino'].$fileNameMd5,100);	//Grava a imagem no destino
					}				
				}	
				echo json_encode(array("status"=>true,"arquivo"=>$fileNameMd5));
				exit;
			}else
			{
				echo json_encode(array("status"=>false,"exception"=>"Ops! Falha ao mover o arquivo."));
				exit;
			}
		}else
		{
			//echo json_encode(array("status"=>false,"exception"=>"Ops! Formato de imagem não avaliado."));
			//exit;
			$arrValida['status'] = false;
			$arrValida['exception'] = "Ops! Formato de imagem não avaliado.";
		}	
	}
	echo json_encode($arrValida);
}

// 
// 
// 
// 
// 
// 
// 
// 
// $output_dir = $_REQUEST['dir']."/";
// if(isset($_FILES["myfile"]))
// {
	// $ret = array();
// 
	// $error =$_FILES["myfile"]["error"];
	// //You need to handle  both cases
	// //If Any browser does not support serializing of multiple files using FormData() 
	// if(!is_array($_FILES["myfile"]["name"])) //single file
	// {
 	 	// $fileName = $_FILES["myfile"]["name"];
 		// move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir.md5($fileName.time()));		
    	// $ret[]= $fileName;
	// }
	// else  //Multiple files, file[]
	// {
	  // $fileCount = count($_FILES["myfile"]["name"]);
	  // for($i=0; $i < $fileCount; $i++)
	  // {
	  	// $fileName = $_FILES["myfile"]["name"][$i];
		// move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.$fileName);
	  	// $ret[]= $fileName;
	  // }
// 	
	// }
    // echo json_encode($ret);
 // }
?>