<table	class="table">
	<tr>
		<th>Sr. No.</th>
		<th>Document</th>
		<th>Action</th>
	</tr>
	<?php 
		if($data != ""){ 
			$i=1;
			foreach ($data as $key => $value) {
			?>
			<tr>
				<td>{{$i}}</td>
				<td><a href="{{url('uploaded/'.$value['document_path'])}}" target="_blank">{{$value['name']}}</a></td>

				<td><a href="javascript:;" onclick="return deleteDoc({{$value['id']}});" ><i class="icon-trash text-danger"></i></a></td>
			</tr>	
			<?php
			$i++;
			}
		}else{
			?>
			<tr> 
				<td colspan="4">No Document Found.</td>
			</tr>
			<?php
		}
	?>
</table> 
<hr>		

<script> 
	
        
         function getDocList(return_id){
            //alert(return_id);
            $.ajax({
                   url: '<?php echo url("getDocList");?>', // le nom du fichier indiqué dans le formulaire
                   type: 'post',
                   data     : {id:return_id},
                   success:function(data) {
                      $('#documentList').html(data);  
                   }
                });
        }
        
        function deleteDoc(id) {

        bootbox.confirm({message: "Are you sure you want to Delete?",
                buttons: {
                confirm: {
                label: 'Yes',
                        className: 'btn-success'
                },
                        cancel: {
                        label: 'No',
                                className: 'btn-danger'
                        }
                },
                callback: function (result) {
                if (result) { // if result set to true
                $.ajax({
                type: "post",
                        url: '<?php echo url("deleteDoc");?>',
                        data: "id=" + id,
                        success: function (data) {

                        }
                }).done(function (data) {
                if (data == '1') {
                bootbox.alert("Document deleted Successfully!");
                getDocList($('#user_id').val())
                } else {
                bootbox.alert("something wrong Please try again later.");
                
                }

                }); //ajax ends
                }
                } // callback function ends

        }); // bootbox confirm ends
        }    

</script>
</script>	