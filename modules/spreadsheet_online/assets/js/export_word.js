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