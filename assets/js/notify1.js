
function notify(id,url,header,body){

        function onShowNotification () {
            console.log('notification is shown!');
        }
        function onCloseNotification () {
            console.log('notification is closed!');
        }
        function onClickNotification () {
            //getUrl = window.location;
           // var baseUrl = getUrl .protocol + "//" + getUrl.host + "/";
         //window.location.href=baseUrl+"admin/"+url
        }
        function onErrorNotification () {
            console.error('Error showing notification. You may need to request permission.');
        }
        function onPermissionGranted () {
            console.log('Permission has been granted by the user');
            doNotification();
        }
        function onPermissionDenied () {
            console.warn('Permission has been denied by the user');
        }
        function doNotification () {
            var myNotification = new Notify(header, {
                body: body,
                notifyClose: onCloseNotification,
                notifyClick: onClickNotification,
                notifyError: onErrorNotification,
                timeout: 5
            });
            myNotification.show();
        }
        if (!Notify.needsPermission) {
            doNotification();
        } else if (Notify.isSupported()) {
            Notify.requestPermission(onPermissionGranted, onPermissionDenied);
        }
     
    }