(function(){

    app.module('example')
        .controller('foobar', ['$scope', function($scope) {
            $scope.wut = 'Hello World!'
        }]);

})();
