<? 
$con = mysql_connect('localhost', 'root', '36631213') or die('Could not connect: ' . mysql_error()); 
mysql_select_db('coolbook', $con) or die ('Can\'t use database : ' . mysql_error()); 
$str = "SELECT * FROM product p, detail d WHERE p.PId=d.PId ORDER BY p.PId"; 
$result = mysql_query($str) or die("Invalid query: " . mysql_error()); 

if($result) 
{ 
	$xmlDoc = new DOMDocument(); 	
	$xmlstr = "<?xml version='1.0' encoding='utf-8' ?>
	<?xml-stylesheet type='text/xsl' href='booklist.xsl'?>
	<products></products>"; 
	$xmlDoc->loadXML($xmlstr); 
	$xmlDoc->save("product.xml"); 


    $Root = $xmlDoc->documentElement; 

    while ($arr = mysql_fetch_array($result))
    { 
	    $id = $arr["PId"];
		$node0 = $xmlDoc->createElement("item"); 
		$node1 = $xmlDoc->createElement("id"); 
		$text1 = $xmlDoc->createTextNode(iconv("GB2312","UTF-8",$arr["PId"])); 
		$node1->appendChild($text1); 		
		$node2 = $xmlDoc->createElement("name"); 
		$text2 = $xmlDoc->createTextNode(iconv("GB2312","UTF-8",$arr["PName"])); 
		$node2->appendChild($text2); 
		$node3 = $xmlDoc->createElement("price"); 
		$text3 = $xmlDoc->createTextNode(iconv("GB2312","UTF-8",$arr["PPrice"])); 
		$node3->appendChild($text3);
		$node4 = $xmlDoc->createElement("category"); 
		$text4 = $xmlDoc->createTextNode(iconv("GB2312","UTF-8",$arr["PCate"])); 
		$node4->appendChild($text4);
		$node5 = $xmlDoc->createElement("picture"); 
		$text5 = $xmlDoc->createTextNode(iconv("GB2312","UTF-8",$arr["Image"])); 
		$node5->appendChild($text5);
		$node6 = $xmlDoc->createElement("specialsale");
				
		$str2 = "SELECT * FROM specialsale s WHERE s.PId = '$id' "; 
        $result2 = mysql_query($str2); 	
		if($arr2 = mysql_fetch_array($result2))
		{
			
			$node7 = $xmlDoc->createElement("price"); 
		    $text7 = $xmlDoc->createTextNode(iconv("GB2312","UTF-8",$arr2["SPrice"])); 
		    $node7->appendChild($text7);
			$node8 = $xmlDoc->createElement("discount"); 
		    $text8 = $xmlDoc->createTextNode(iconv("GB2312","UTF-8",$arr2["Discount"])); 
		    $node8->appendChild($text8);
			$node9 = $xmlDoc->createElement("start"); 
		    $text9 = $xmlDoc->createTextNode(iconv("GB2312","UTF-8",$arr2["Startdate"])); 
		    $node9->appendChild($text9);
			$node10 = $xmlDoc->createElement("end"); 
		    $text10 = $xmlDoc->createTextNode(iconv("GB2312","UTF-8",$arr2["Enddate"])); 
		    $node10->appendChild($text10);
				
	    	$node6->appendChild($node7);
		    $node6->appendChild($node8);
	    	$node6->appendChild($node9);
	    	$node6->appendChild($node10);													
		
		}	
				
		$node0->appendChild($node1);		
		$node0->appendChild($node2);
		$node0->appendChild($node3);
		$node0->appendChild($node4);
		$node0->appendChild($node5);
		$node0->appendChild($node6);
		
		$Root->appendChild($node0); 		
		$xmlDoc->save("product.xml"); 
    } 
} 
mysql_close($con); 
?> 