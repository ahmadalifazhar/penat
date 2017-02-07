<?
//Give actual path here
if(isset($_GET['file'])){
    $file = $_GET['file'];
}
$file_real = $file;
if (file_exists($file_real)){
            // Get extension of requested file
            echo $extension = strtolower(substr(strrchr($file, "."), 1));
            // Determine correct MIME type
            
            switch($extension){
                case "avi": $type = "video/x-msvideo"; break;
                case "exe": $type = "application/octet-stream"; break;
                case "mov": $type = "video/quicktime"; break;
                case "mp3": $type = "audio/mpeg"; break;
                case "mpg": $type = "video/mpeg"; break;
                case "mpeg": $type = "video/mpeg"; break;
                case "rar": $type = "encoding/x-compress"; break;
                case "txt": $type = "text/plain"; break;
                case "wav": $type = "audio/wav"; break;
                case "wma": $type = "audio/x-ms-wma"; break;
                case "wmv": $type = "video/x-ms-wmv"; break;
                case "zip": $type = "application/x-zip-compressed"; break;
                case "asf": $type = "video/x-ms-asf"; break;
                default: $type = "application/force-download"; break;
            }
// Fix IE bug [0]
$header_file = (strstr($_SERVER['HTTP_USER_AGENT'], 'MSIE')) ? preg_replace('/\./', '%2e', $file, substr_count($file, '.') - 1) : $file;
// Prepare headers
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public", false);
header("Content-Description: File Transfer");
header("Content-Type: " . $type);
header("Accept-Ranges: bytes");
header("Content-Disposition: attachment; filename=\"" . $header_file . "\";");
header("Content-Transfer-Encoding: binary");
header("Content-Length: " . filesize($file_real));
// Send file for download
if ($stream = fopen($file_real, 'rb')){
while(!feof($stream) && connection_status() == 0){
//reset time limit for big files
set_time_limit(0);
print(fread($stream,1024*8));
flush();
}
fclose($stream);
}
}else{
// Requested file does not exist (File not found)
echo("Requested file does not exist");
die();
}

?>