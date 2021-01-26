<script type="text/javascript">
  (function(){
    "use strict";
    

    if((<?php echo $tree_save ?>).length >= 0){
      //alert("combo tree");
      //alert($tree_save);
      var tree = $('input[name="folder"]').comboTree({
        source : <?php echo $tree_save ?>
      });   
    }

    $('input[name="folder"]').on('change', function(){
      //alert("changed folder");
      var id = tree.getSelectedItemsId();
      $("input[name='parent_id']").val(id.replace( /^\D+/g, ''));
    })
    if((<?php echo isset($data_form) ? "true" : "false"?>)){
      var data = <?php echo isset($data_form) ? ($data_form != "" ? $data_form : '""') : '""' ?>;
      var title = "<?php echo isset($file_excel) ? $file_excel->name : "Untitled" ?>";
      $("#word_info_detail_input").val(title);
    }

    var text_plugins =  [
                        'advlist pagebreak autolink autoresize lists link image charmap hr',
                        'searchreplace visualblocks visualchars code',
                        'media nonbreaking table contextmenu',
                        'paste textcolor colorpicker'
                        ];
    tinymce.init({
                    selector: '#mytextarea',
                    plugins:  text_plugins,
                    imagetools_cors_hosts: ['picsum.photos'],
                    menubar: 'file edit view insert format tools table help',
                    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
                    toolbar_sticky: true,
                    autosave_ask_before_unload: true,
                    autosave_interval: '30s',
                    autosave_prefix: '{path}{query}-{id}-',
                    autosave_restore_when_empty: false,
                    autosave_retention: '2m',
                    setup: function (editor) {
                        editor.on('init', function (e) {
                              if (typeof data !== 'undefined')
                                {
                                  //alertdata);
                                  editor.setContent(data);
                                }
                         })},
            });


    var type_screen = $("input[name='type']").val();
    var role = $("input[name='role']").val();

    if(type_screen == 3){
      $('.word_info_detail_save_as').remove();
    }
    if(role == 1){
      $('.word_info_detail_save_as').remove();
      $('.luckysheet_info_detail_save').remove();
      $('.word_info_detail_save').remove();
    }
      
  })(jQuery);



</script>

