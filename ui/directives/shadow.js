angular.module('shadow',[])
	.directive('shadow', function() {
	  return {
	    scope: true,
	    link: function(scope, el, att) {
	      scope[att.shadow] = angular.copy(scope[att.shadow]);

	      scope.commit = function() {
	        scope.$parent[att.shadow] = angular.copy(scope[att.shadow]);
	      };
	    }
	  };
});