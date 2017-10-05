
        function onShowNotification () {
            console.log('ulala');
        }
        function onCloseNotification () {
            console.log('notification is closed!');
        }
        function onClickNotification () {
             onCloseNotification();
             window.location.href="<?php echo base_url();?>chating"
        }
        function doNotification () {
            var myNotification = new Notify("You've got new message from:\n"
                //tag: 'My unique id'
               , {
                body:"Ulala",
                notifyShow: onShowNotification,
                notifyClose: onCloseNotification,
                notifyClick: onClickNotification,
                timeout: 5,
            });
            myNotification.show();
        }