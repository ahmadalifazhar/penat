<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<?php
//link to database
include "../../config.php";
include "../../accDB.php";
include "../../functions.php";
include "../../mailsys.php";
include "../account/accounts.sys.php";
//--------------------------------------
?>

<link href="../../../metro/css/modern.css" rel="stylesheet">
<link href="../../../metro/css/modern-responsive.css" rel="stylesheet">
<link href="../../../metro/css/site.css" rel="stylesheet" type="text/css">
<link href="../../../metro/js/google-code-prettify/prettify.css" rel="stylesheet" type="text/css">
<link href="../../../metro/js/tinybox/tiny.css" rel="stylesheet" type="text/css">
<link href="../../../metro/js/modern/dialog.js" rel="stylesheet" type="text/css"/>

</head>

<body class="metrouicss">


<table>
<form method="post" enctype="multipart/form-data" action="uploadprocesswish.php" >
<!--
action
aid
wtype
wtitle
wdescription
wquantity
wprice
file
-->
<input type="hidden" name="action" value="wish" />
<input type="hidden" name="aid" value="<?php echo $chkid; ?>" />
    <tr>
        <td width="15%">Category</td>
        <td>
        <div class="input-control select" style="width:50%">
            <select name="wtype">
                <option selected="selected" disabled="disabled" value="unchecked">Select item category</option>
                <option value="Vehicles">Vehicles</option>
                <option value="Properties">Properties</option>
                <option value="Electronics">Electronics</option>
                <option value="Personal Items">Personal Items</option>
                <option value="Hobbies">Hobbies</option>
                <option value="Services">Services</option>
                <option value="Others">Others</option>
            </select>
        </div>
        </td>
    </tr> 
    <tr>
        <td>Title</td>
        <td>
        <div class="input-control text">
            <input type="text" placeholder="Enter item title" name="wtitle" required="required"/>
            <button class="btn-clear" tabindex="-1" type="button" />
        </div>
        </td>
    </tr>
    <tr>
        <td valign="top">Description</td>
        <td>
        <div class="input-control textarea">
            <textarea placeholder="Enter item description" name="wdescription" required="required"></textarea>
        </div>
        </td>
    </tr>
    <tr>
        <td valign="top">Quantity</td>
        <td>
        <div class="input-control text">
            <input type="number" placeholder="Enter item quantity" name="wquantity" required="required"/>
            <button class="btn-clear" tabindex="-1" type="button" />
        </div>
        </td>
    </tr>
    <tr>
        <td valign="top">Price (RM)</td>
        <td>
        <div class="input-control text">
            <input type="number" placeholder="Enter item price (199.99)" name="wprice" required="required"/>
            <button class="btn-clear" tabindex="-1" type="button" />
        </div>
        </td>
    </tr>
    <tr>
        <td valign="top">Picture</td>
        <td><label for="file">Filename:</label>
            <input type="file" name="file" id="file">
            
        </td>
    </tr>
    <tr>
    	<td colspan="2"><input type="submit" /></form><a href="mywishlist.php"><button>Back</button></a></td>
    </tr>
</table> 


</body>
</html>