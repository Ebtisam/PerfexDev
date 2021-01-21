$("#tinymce_info_detail_export").on('click', function (e) {
    alert("tiny");
    var myContent = tinymce.get("mytextarea").getContent();
    var doc_name = $("#word_info_detail_input").val();
    alert(doc_name);
    ExportToDoc(myContent,doc_name);
});

//Export text to Word Document
function ExportToDoc(myContent , doc_name){
    var HtmlHead = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML To Doc</title></head><body>";
    var EndHtml = "</body></html>";
    
    alert(doc_name);
    //complete html
    var html = HtmlHead +myContent+EndHtml;

    //specify the type
    var blob = new Blob(['\ufeff', html], {type: 'application/msword' });
    
    // Specify link url
    var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);
    
    
    // Specify file name
    filename="untitled";
    filename = doc_name?doc_name+'.doc':filename+'.doc';
    
    // Create download link element
    var downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob ){
        navigator.msSaveOrOpenBlob(blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = url;
        
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }

    document.body.removeChild(downloadLink);
}

//Save text to db

$("form#word-file-form").on('submit', function (e) {
    //stop form submission
        e.preventDefault();

        var rawData = tinymce.get("mytextarea").getContent();
        alert("submit");
        var finalData = JSON.stringify(rawData);
        alert(finalData);
        var formData = new FormData(this);
        var name = $("#word_info_detail_input").val();
        alert(name);
        var id = $("input[name='id']").val();
        formData.append('data_form', finalData);
        formData.append('name', name);
        formData.append('id', id);
        formData.append('image_flag', "false");
        formData.delete("mytextarea");
        alert(formData);
        $.ajax({
                    url: $(this).attr("action"),
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    success: function (response, status, xhr) {
                        alert(response);
                        response = JSON.parse(response);
                        if(response.success == true) {
                        alert_float('success', response.message);
                        var disposition = xhr.getResponseHeader('content-disposition');
                        //$('#SaveAsModal').modal('hide');
                        }
                        else{
                        alert_float('warning', response.message);
                        }
                    },
                    cache: false,
                    processData: false
             })

    });

//Save as Modal

$('.word_info_detail_save_as').on('click', function(){
    $('#SaveAsModal').modal('show');
      var old = $("input[name='parent_id']").val();
      alert(old)
    $('#SaveAsModal [type="submit"]').on('click', function(){
      if(old != $("input[name='parent_id']").val()){
        $("input[name='id']").val('');
      }
        var url_form = $("form#word-file-form").attr('action');
        var rawData = tinymce.get("mytextarea").getContent();
          alert("submit save as");
          var finalData = JSON.stringify(rawData);
          alert(finalData);
          var formData = new FormData(this);
          var name = $("#word_info_detail_input").val();
          alert(name);
          var id = $("input[name='id']").val();
          formData.append('data_form', finalData);
          formData.append('name', name);
          formData.append('id', id);
          formData.append('image_flag', "false");
          formData.delete("mytextarea");
        if(typeof  $('input[name="csrf_token_name"]').val() !== 'undefined'){
          formData.append('csrf_token_name', $('input[name="csrf_token_name"]').val());
        }

        $.ajax({
          url: url_form,
          type: 'POST',
          data: formData,
          success: function (response, status, xhr) {
            response = JSON.parse(response);
            if(response.success == true) {
              alert_float('success', response.message);
              var disposition = xhr.getResponseHeader('content-disposition');
              $('#SaveAsModal').modal('hide');
            }
            else{
              alert_float('warning', response.message);
            }
          },
          cache: false,
          contentType: false,
          processData: false
        })

    })
  });