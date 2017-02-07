<?php

$isnotuser = true;
	if (isset($_REQUEST[userid]))
	{
		$cloud = new getUser();
		$check = $cloud->qUser($_REQUEST[userid]);
		
		if (!$check)
		{		
			include $module_root."lib/error.php";
			die();
		}
		
			if ($_REQUEST[userid] == $userunq)
			{
				$isnotuser = false;
				
			}
			else
			{
				$isnotuser = true;
			}
		//query for user n non-user
		$cloud = new getUser();
		$cloud->qUser($_REQUEST[userid]);
		$pagination = new pagination($_REQUEST[userid], "AND (type = \"jpg\" OR type = \"png\" OR type = \"gif\")");
		$pagination->page($_GET[page]);
		
	}
	else
	{
		$isnotuser = false;
		//query for user
		
		$cloud = new getUser();
		$cloud->qUser($userunq);
		$pagination = new pagination($userunq,  "AND (type = \"jpg\" OR type = \"png\" OR type = \"gif\")");
		$pagination->page($_GET[page]);
	}
	
	
	
	?>

<table class="bordered">
              <thead>
                <tr>
                  <th>File Name</th>
                  <th class="right">Extension</th>
                  <th class="right">View/Download</th>
                  <?php if (!$isnotuser){ ?>
                  <th class="right">Share</th>
                  <?php } ?>
                </tr>
              </thead>
              <tbody>
                <?php 
				
						
			//getCloudList($start, $limit)	
		$userfiles_photo = $cloud->getCloudListPic($pagination->getStart(), $pagination->getLimit()); 
			foreach ($userfiles_photo as $value)
			{
				$share = "";
				if (!$isnotuser)
				{
					$share = "<td class=\"right\"><button  style=\"margin-right:0px;margin-bottom:0px\" class=\"bg-color-pink fg-color-white\" onclick=\"TINY.box.show({iframe:'?op=cloud&go=cshare&ids=".$value[cloud_id]."',width:300,height:300,boxid:'frameless',fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){closeJS()}})\"><i class=\"icon-share\"></i>Share</button></td>";
					$dlt_chkbox = "<input type=\"checkbox\">&nbsp;";
					$dlt_btn = "<div><button class=\"bg-color-blue fg-color-white\">Delete</button></div>";
				}
				else 
				{
					$share = "";
					$dlt_chkbox = "";
					$dlt_btn = "";
				}
				
				$link_file = 'modules/pages/cloud/files/'.$cloud->getAid().'/'.$value[location];
				
				if (($value[type] == "jpg") 
				|| ($value[type] == "png") 
				|| ($value[type] == "gif")) 
				{
					$link_file = "javascript:TINY.box.show({image:'".$link_file."',boxid:'frameless',fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){closeJS()}})";
				}
				else if (($value[type] == "mp3") 
				|| ($value[type] == "m4a")) 
				{
					//onclick="TINY.box.show({,width:200,height:100,opacity:20,topsplit:3})"
					$link_file = "javascript:TINY.box.show({iframe:'?op=cloud&go=player&play=1&id=".$cloud->getAid()."&file=".$value[location]."',width:300,height:24,boxid:'frameless',fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){closeJS()}})";
				}
				else if ($value[type] == "mp4") 
				{
					//onclick="TINY.box.show({,width:200,height:100,opacity:20,topsplit:3})"
					$link_file = "javascript:TINY.box.show({url:'?op=cloud&go=player&play=2&id=".$cloud->getAid()."&file=".$value[location]."',width:750,height:450,boxid:'frameless',fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){closeJS()}})";
				}
								
				$filename = $cloud->explode_file_dir($value[location]);
				$filename_temp = array_pop($filename);
				$filename_temp2 = array_pop($filename);
				$a_size = count($filename);
				//$link_file = 'modules/pages/cloud/files/'.$cloud->getAid().'/'.$value[location];
				if ($a_size > 1)
				{
					$filename = implode("_", $filename);
					echo "<tr><td>".$dlt_chkbox."<span class=\"fg-color-greenDark\">";
					echo  wordwrap($filename, 30, "<br/>\n", true)."</span></td>"."<td class=\"right\">".$value[type]."</td><td class=\"right\"><button onclick=\"".$link_file."\" style=\"margin-right:0px;margin-bottom:0px\" class=\"bg-color-greenDark fg-color-white\"><i class=\"icon-download\"></i>Download/View</button></td>".$share;
				}
				else
				{	
					echo "<tr><td>".$dlt_chkbox."<span class=\"fg-color-greenDark\">";
					echo  wordwrap($filename[0], 30, "<br/>\n", true)."</span></td>"."<td class=\"right\">".$value[type]."</td><td class=\"right\"><button onclick=\"".$link_file."\" style=\"margin-right:0px;margin-bottom:0px\" class=\"bg-color-greenDark fg-color-white\"><i class=\"icon-download\"></i>Download/View</button></td>".$share;
				
				}
				
			//	$filename = $cloud->explode_file_dir($value[location]);
			//	$text = "";
			//	for ($i = 0; $i < (count($filename)-2); $i++)
			//		$text .= $filename[$i]."_";
			//	$text = substr($text, 0, (strlen($text)-1));
			//	echo $text." - ".$value[type]."<br/>";
				
			
				
			}
			?>
              </tbody>
            </table>
            <?php  echo $dlt_btn; ?>
            
            <?php
          /* Setup page vars for display. */
		  $page = $pagination->getPage();
		if ($page == 0) $page = 1;					//if no page var is given, default to 1.
		$prev = $page - 1;							//previous page is page - 1
		$next = $page + 1;							//next page is page + 1
		$lastpage = ceil($pagination->totalPage()/$pagination->getLimit());		//lastpage is = total pages / items per page, rounded up.
		$lpm1 = $lastpage - 1;						//last page minus 1
		
		/* 
			Now we apply our rules and draw the pagination object. 
			We're actually saving the code to a variable in case we want to draw it more than once.
		*/
		?>
        					 
       <?php if ($pagination->totalPage() > 10)
	   { ?>
		   
	                         <div class="pagination">
                                <ul style="text-align:center">
                                    <li class="first" onclick="navigate_photo(1);"><a></a></li>
                                    <li class="prev" onclick="navigate_photo(<?php if ($page == 1){echo "1";}else {echo $prev;}?>);"><a></a></li>
                                    
                                    <li class="spaces"><a>...</a></li>
                                    <li class="active"><a><?php echo $page; ?></a></li>
                                    <li class="spaces"><a>...</a></li>
                                                       
                                    <li class="next" onclick="navigate_photo(<?php if ($page == $lastpage){echo $lastpage;}else{ echo $next;}?>);"><a></a></li>
                                    <li class="last" onclick="navigate_photo(<?php echo $lastpage;?>);"><a></a></li>
                                </ul>
                            </div>
                            <?php } ?>