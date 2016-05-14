app.controller('ContactController', function ($scope, $http, $compile) {
    $scope.result = 'hidden'
    $scope.resultMessage;
    $scope.formData; //formData is an object holding the name, email, subject, and message
    $scope.submitButtonDisabled = false;
    $scope.submitted = false; //used so that form errors are shown only after the form has been submitted
    $scope.submit = function(contactform) {
        $scope.submitted = true;
        $scope.submitButtonDisabled = true;
        if (contactform.$valid) {
            $http({
                method  : 'POST',
                url     : 'contact-form.php',
                data    : $.param($scope.formData),
                headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
            }).success(function(data){
                console.log(data);
                if (data.success) {
                    $scope.submitButtonDisabled = true;
                    $scope.resultMessage = window.alert("Mensaje Enviado!");
                    $scope.result='';
                } else {
                    $scope.submitButtonDisabled = false;
                    $scope.resultMessage = window.alert("Mensaje No Enviado!");
                    $scope.result='bg-danger';
                }
            });
        }
    }
});