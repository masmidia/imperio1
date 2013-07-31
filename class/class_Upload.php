<?php
require_once("Dao.class.php");
require_once("Util.class.php");



//class Upload extends Dao
class Upload_Mulpiplos
{
	
	
	/*-------------------------------------------------------------------------------------------------------------------*/
	/*	CSS 	*/
	/*-------------------------------------------------------------------------------------------------------------------*/
	private function css()
	{
	?>
		<style type="text/css" >
            #swfupload-control p{ margin:10px 5px; font-size:0.9em; }
            #log{ margin:0; padding:0; width:500px;}
            #log li{ list-style-position:inside; margin:2px; border:1px solid #ccc; padding:10px; font-size:12px;
                font-family:Arial, Helvetica, sans-serif; color:#333; background:#fff; position:relative;}
            #log li .progressbar{ border:1px solid #333; height:5px; background:#fff; }
            #log li .progress{ background:#999; width:0%; height:5px; }
            #log li p{ margin:0; line-height:18px; }
            #log li.success{ border:1px solid #339933; background:#ccf9b9; }
            #log li span.cancel{ position:absolute; top:5px; right:5px; width:20px; height:20px;
                background:url(<?php echo Util::caminho_projeto(); ?>/jquery/swfupload/js/swfupload/cancel.png) no-repeat; cursor:pointer; }
        </style>
    <?php	
	}
	
	
	
	
	/*-------------------------------------------------------------------------------------------------------------------*/
	/*	CSS 	*/
	/*-------------------------------------------------------------------------------------------------------------------*/
	private function js($tamanho_limite, $tipo_arquivos, $qtd_maxima_arquivos)
	{
	?>
    	<script type="text/javascript" src="<?php echo Util::caminho_projeto(); ?>/jquery/swfupload/js/jquery-1.3.2.js"></script>
		<script type="text/javascript" src="<?php echo Util::caminho_projeto(); ?>/jquery/swfupload/js/swfupload/swfupload.js"></script>
        <script type="text/javascript" src="<?php echo Util::caminho_projeto(); ?>/jquery/swfupload/js/jquery.swfupload.js"></script>
    	<script type="text/javascript">
			$(function(){
				$('#swfupload-control').swfupload({
					upload_url: "<?php echo Util::caminho_projeto(); ?>/jquery/swfupload/upload-file.php",
					file_post_name: 'uploadfile',
					//file_size_limit : "1024",
					file_size_limit : <?php echo $tamanho_limite; ?>,
					//file_types : "*.jpg;*.png;*.gif",
					file_types : "<?php echo $tipo_arquivos; ?>",
					file_types_description : "Image files",
					//file_upload_limit : 5,
					file_upload_limit : <?php echo $qtd_maxima_arquivos; ?>,
					flash_url : "<?php echo Util::caminho_projeto(); ?>/jquery/swfupload/js/swfupload/swfupload.swf",
					button_image_url : '<?php echo Util::caminho_projeto(); ?>/jquery/swfupload/js/swfupload/wdp_buttons_upload_114x29.png',
					button_width : 114,
					button_height : 29,
					button_placeholder : $('#button')[0],
					debug: false
				})
					.bind('fileQueued', function(event, file){
						var listitem='<li id="'+file.id+'" >'+
							'File: <em>'+file.name+'</em> ('+Math.round(file.size/1024)+' KB) <span class="progressvalue" ></span>'+
							'<div class="progressbar" ><div class="progress" ></div></div>'+
							'<p class="status" >Aguardando na fila</p>'+
							'<span class="cancel" >&nbsp;</span>'+
							'</li>';
						$('#log').append(listitem);
						$('li#'+file.id+' .cancel').bind('click', function(){ //Remove from queue on cancel click
							var swfu = $.swfupload.getInstance('#swfupload-control');
							swfu.cancelUpload(file.id);
							$('li#'+file.id).slideUp('fast');
						});
						// start the upload since it's queued
						$(this).swfupload('startUpload');
					})
					.bind('fileQueueError', function(event, file, errorCode, message){
						alert('Size of the file '+file.name+' is greater than limit');
					})
					.bind('fileDialogComplete', function(event, numFilesSelected, numFilesQueued){
						$('#queuestatus').text('Files Selected: '+numFilesSelected+' / Queued Files: '+numFilesQueued);
					})
					.bind('uploadStart', function(event, file){
						$('#log li#'+file.id).find('p.status').text('Enviando, por favor aguarde...');
						$('#log li#'+file.id).find('span.progressvalue').text('0%');
						$('#log li#'+file.id).find('span.cancel').hide();
					})
					.bind('uploadProgress', function(event, file, bytesLoaded){
						//Show Progress
						var percentage=Math.round((bytesLoaded/file.size)*100);
						$('#log li#'+file.id).find('div.progress').css('width', percentage+'%');
						$('#log li#'+file.id).find('span.progressvalue').text(percentage+'%');
					})
					.bind('uploadSuccess', function(event, file, serverData){
						var item=$('#log li#'+file.id);
						item.find('div.progress').css('width', '100%');
						item.find('span.progressvalue').text('100%');
						//var pathtofile='<a href="<?php //echo Util::caminho_projeto(); ?>/uploads/'+file.name+'" target="_blank" >Vizualizar &raquo;</a>';
						var pathtofile='';
						item.addClass('success').find('p.status').html('Finalizado!!! | '+pathtofile);
					})
					.bind('uploadComplete', function(event, file){
						// upload has completed, try the next one in the queue
						$(this).swfupload('startUpload');
					})
			});
			</script>
    <?php
	}
	
	
	/*-------------------------------------------------------------------------------------------------------------------*/
	/*	HTML 	*/
	/*-------------------------------------------------------------------------------------------------------------------*/
	public function limpa_valores_session()
	{
		unset($_SESSION[nome_arquivo]);
	}
	
	
	
	
	/*-------------------------------------------------------------------------------------------------------------------*/
	/*	HTML 	*/
	/*-------------------------------------------------------------------------------------------------------------------*/
	public function exibe_html_upload()
	{
		$this->css();
		$this->js("5024", "*.jpg;*.png;*.gif; *.doc; *.pdf", 20);
		$this->limpa_valores_session();
	?>
        <div id="swfupload-control">
            <input type="button" id="button" />
            <p id="queuestatus" ></p>
            <ol id="log"></ol>
        </div>
	<?php
	}
	
		
	
	
	
	
	
	
}



$up = new Upload_Mulpiplos();
$up->exibe_html_upload();


?>