angular.module('index')
.controller('IndexController', ['$scope', '$routeParams', '$location','$resource','Index','ngProgressLite', function($scope, $routeParams, $location,$resource ,Index,ngProgressLite)
{


	$scope.editingData = [];
	$scope.newUser = new Object;


	$scope.create = function() {

	  	ngProgressLite.start();

		$scope.newUser.password = "123";
		var users = new Index($scope.newUser);
		users.$save(function(response) {
			$scope.message = "Adding user"; 
			$scope.updateObj();
			$scope.newUser = new Object;
	  			ngProgressLite.done();
			},function(errorResponse){
				$scope.error = errorResponse.data.message;
	  			ngProgressLite.done();
				console.log(errorResponse.data.message);
			});
	};

	$scope.updateObj = function (){
		Index.query(function(response){
				angular.copy(response,$scope.users)
		});
	}

	$scope.find = function() {

	  		ngProgressLite.start();
			$scope.users = Index.query(function(){
				loadEdit();
	  			ngProgressLite.done();
			});
			};
	$scope.findOne = function($id){

	  		ngProgressLite.start();

			$scope.user = Index.get({'id':$id},function(){
	  			ngProgressLite.done();
			});
	}
	$scope.update = function(){

	  		ngProgressLite.start();

			$scope.user.$update(function(Response) {

	  			ngProgressLite.start(done);
				}, function(errorResponse) {
	  				ngProgressLite.done();
					console.log(errorResponse);	
		});
	}

	$scope.delete = function(user){
		if(user){
	  		ngProgressLite.start();
			user.$remove({'id':user.ID},function(){
				$scope.updateObj();
			$scope.message = "Delete Item"; 
	  			ngProgressLite.done();

			}, function(errorResponse) {
	  				ngProgressLite.done();
					console.log(errorResponse);	
		})
		}else
		{
	  		ngProgressLite.start();
			$scope.user.$remove({'id':$scope.user.ID},function(){
				$scope.updateObj();
			})
		}
	}

	function loadEdit(){
	for (var i = 0, length = $scope.users.length; i < length; i++) {
	  $scope.editingData[$scope.users[i].ID] = false;
	}

	}

	$scope.modify = function(user){

	   $scope.original = angular.copy($scope.users);
	   console.log($scope.original);
	    $scope.editingData[user.ID] = true;

	    
	};
	$scope.cancelEdit = function(user){
	   console.log($scope.original);
		$scope.users = angular.copy($scope.original);
	    $scope.editingData[user.ID] = false;

	    
	};
	$scope.clearAlert = function(){
		$scope.message = null;
		$scope.error = null;
	}

	$scope.updateTable = function(user){
	  	ngProgressLite.start();
		user.$update({'id':user.ID},function(Response) {
	  		ngProgressLite.done();

				}, function(errorResponse) {
	  				ngProgressLite.done();
					console.log(errorResponse);	
		});

	    $scope.editingData[user.ID] = false;
	    console.log(user);
	};

}

]);




