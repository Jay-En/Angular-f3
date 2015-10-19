angular.module('articles').controller('ArticlesController', ['$scope', '$routeParams', '$location', 'Authentication', 'Articles','ngProgressLite', function($scope, $routeParams, $location, Authentication, Articles, ngProgressLite){
	$scope.authentication = Authentication;

	$scope.create = function() {

	var article = new Articles({
		title: this.title,
		content: this.content,
		tags: this.tags,
		category: this.category
		});

	  	ngProgressLite.start();

	article.$save(function(response) {
		$location.path('articles/' + response._id);
	  	ngProgressLite.done();
			}, function(errorResponse) {
			$scope.error = errorResponse.data.message;	
	  	ngProgressLite.done();
		});
	};

	$scope.find = function() {
			ngProgressLite.start();
			$scope.articles = Articles.query(function(){
			ngProgressLite.done();
		});	
			};
	$scope.findOne = function() {
			ngProgressLite.start();
			$scope.article = Articles.get({
			articleId: $routeParams.articleId
		},function(){
			ngProgressLite.done();
		});
	};


	$scope.update = function() {
	  	ngProgressLite.start();
		$scope.article.$update(function() {
			$location.path('articles/' + $scope.article._id);
	  		ngProgressLite.done();
				}, function(errorResponse) {
	  				ngProgressLite.done();
					$scope.error = errorResponse.data.message;	
		});
	};

	$scope.delete = function(article) {
	  	ngProgressLite.start();
		if (article) {
			article.$remove(function() {
				for (var i in $scope.articles) {
					if ($scope.articles[i] === article) {	
						$scope.articles.splice(i, 1);
						}
					}
					});
					} else {
						$scope.article.$remove(function() {
						$location.path('articles');
						});
						}
					};

	  	ngProgressLite.done();

		}

]);




