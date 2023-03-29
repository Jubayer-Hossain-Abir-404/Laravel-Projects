<script>
    $("#checkPermissionAll").click(function (){
        if($(this).is(':checked')){
            // check all the checkboxes
            $('input[type=checkbox]').prop('checked', true);
        }else{
            // un check all the checkbox
            $('input[type=checkbox]').prop('checked', false);
        }
    });

    function checkPermissionByGroup(className, checkThis){
        const groupIdName = $("#"+checkThis.id);
        const classCheckBox = $('.'+className+' input');

        if(groupIdName.is(':checked')){
            classCheckBox.prop('checked', true);
        }else{
            classCheckBox.prop('checked', false);
        }
        implementAllChecked();
    }

    function checkSinglePermission(groupClassName, groupId, countTotalPermission){
        const classCheckBox = $('.'+groupClassName+' input');
        const groupIDCheckBox = $("#"+groupId);
        // If there is any occurrence where something is selected then make selected - false
        if($('.'+groupClassName+' input:checked').length == countTotalPermission){
            groupIDCheckBox.prop('checked', true);
        }
        else{
            groupIDCheckBox.prop('checked', false);
        }
        implementAllChecked();
    }

    function implementAllChecked(){
       const  countPermissions = {{ count($all_permissions) }};
       const  countPermissionGroups = {{ count($permission_groups) }};

        if($('input[type="checkbox"]:checked').length >= (countPermissions + countPermissionGroups)){
            $("#checkPermissionAll").prop('checked', true);
        }
        else{
            $("#checkPermissionAll").prop('checked', false);
        }
    }
</script>
