<?php
global $nomefile, $idfile;


$icon = "svg-documents";
if(substr($nomefile, -3) == "pdf")
	$icon = "it-pdf-document";
if(substr($nomefile, -3) == "doc")
	$icon = "svg-doc-document";
if(substr($nomefile, -4) == "docx")
	$icon = "svg-doc-document";
if(substr($nomefile, -3) == "xml")
	$icon = "svg-xml-document";

$ext = substr($nomefile, -4);

$attach = get_post($idfile);
$filetocheck = get_attached_file($idfile);

$filesize = filesize($filetocheck);
$fulltype = mime_content_type($filetocheck);
$arrtype = explode("/", $fulltype);
$arrtype_more = explode(".", $arrtype[count($arrtype)-1]);
if(is_array($arrtype_more)) {
    $arrtype = $arrtype_more;
}
$type = "file";
if(is_array($arrtype))
    $type = $arrtype[count($arrtype)-1];

$ptitle = $attach->post_title;
if(trim($ptitle) == ""){
    $ptitle = str_replace("-", " ", basename($filetocheck, $ext));
    $ptitle = str_replace("_", " ", $ptitle);
}
?>
	<div class="card card-icon flex flex-row align-items-center p-0">
		<div class="p-2">
			<svg class="icon <?php echo $icon; ?>" role="img"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#<?php echo $icon; ?>"></use></svg>
		</div>
		<div class="card-icon-content pl-2">
			<p><strong><a target="_blank" class="h6" href="<?php echo $attach->guid; ?>"  aria-label="Vai alla scheda <?php echo $ptitle; ?>"><?php echo $ptitle; ?></a></strong></p>
		</div><!-- /card-icon-content -->
	</div><!-- /card card-bg card-icon rounded -->
<?php


