initSample();
initSample2();
function showMeta(){
	$('#myModal').modal();
}
function save(){
	if(CKEDITOR.instances.content)
    {
        var content = CKEDITOR.instances.content.getData();
        var content = encodeURIComponent(content);
    }
    if(CKEDITOR.instances.content2)
    {
    	var content2 = CKEDITOR.instances.content2.getData();
    	var content2 = encodeURIComponent(content2);
    }
    
    $.post('/savePage', {page_id: 1, title: $('#title').val(),seo_keywords: $('#seo_keywords').val(),seo_description: $('#seo_description').val(),content: content, content2: content2, description_for_home_page: $('#description_for_home_page').val(), alt_for_image: $('#alt_for_image').val()}, function(){
        location.reload();
    });
}
					