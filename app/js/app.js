var myApp = angular.module("blog", ["ngRoute"]);
myApp.config(function($routeProvider){
    $routeProvider
    //homapage- displays all posts
    .when('/', {
        templateUrl: 'templates/posts.html',
        controller: 'postsCtrl'
    })
    //add post page
    .when('/addPost', {
        templateUrl: 'templates/addPost.html',
        controller: 'addCtrl'
    })
    //delete post page
    .when('/delete/:id', {
        templateUrl: 'templates/delete.html',
        controller: 'deleteCtrl'
    })
});

//prevents angular from addind unwanted characters to the url
myApp.config(['$locationProvider', function($locationProvider) {
  $locationProvider.hashPrefix('');
}]);

myApp.controller("postsCtrl", function($scope, $http){
    $http.get("http://localhost:8080/blog/webService/allPosts.php")
    .then(function(res){
        //all posts in database
        $scope.posts = res.data;
    })
    .catch(function(error){
        console.log("error reading JSON file ",error);
    });
});

myApp.controller("addCtrl", function($scope){

    /*unbind() prevents ajax call from firing twice*/
    $("#submitButton").unbind("click").click(function(){
        
        var title = $("#title-input").val();
        var content = $("#text-input").val();

        if (title == "") {
            $('#message').html("You cant add a post without a title");
        }
        else if (content == "") {
            $('#message').html("You cant add an empty post");
        }
        else{
            //post the form informaion with an ajax call
           $.ajax({
                type : 'POST',
                url: 'http://localhost:8080/blog/webService/addPost.php',
                data: {'title': title , 'content': content},
                success: function ( data ,status) {
                    var title = $("#title-input").val("");
                    var content = $("#text-input").val("");
                    $('#message').html("Post posted");
                },
                error: function ( xhr, desc, err) {
                    console.log("Details: " + desc + "\nError:" + err);
                }
            }); 
        }
        return false;   
    });
});

myApp.controller("deleteCtrl", function($scope, $http, $routeParams){
    $http({
        url:"http://localhost:8080/blog/webService/delete.php",
        params: {id:$routeParams.id},
        method: "get"
    })
    .then(function(res){
        $scoep.posts = res.data;
    });
});