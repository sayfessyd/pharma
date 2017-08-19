app.controller("HomeController", function($scope, $filter)
{
    var orderBy = $filter('orderBy');
    $scope.orderGains = function(predicate, reverse) {
        $scope.stat.gains = orderBy($scope.stat.gains, predicate, reverse);
    };
    $scope.orderDepenses = function(predicate, reverse) {
        $scope.stat.depenses = orderBy($scope.stat.depenses, predicate, reverse);
    };
});
app.controller("FamilleController", function($scope, $filter)
{
    var orderBy = $filter('orderBy');
    $scope.order = function(predicate, reverse) {
        $scope.familles = orderBy($scope.familles, predicate, reverse);
    };
    $scope.confirmer = function(index)
    {
        $scope.id = $scope.familles[index].id;
        $(".popup").fadeTo(200,1);
        $(".popup").css('display','block');
    }
    $scope.annuler = function()
    {
        $(".popup").css('display','none');
    }
    $scope.supprimer = function()
    {
        window.location = "http://localhost/pharma/public/supprimer/famille/" + $scope.id;
    }
});
app.controller("MedicamentController", function($scope, $filter)
{
    var orderBy = $filter('orderBy');
    $scope.order = function(predicate, reverse) {
        $scope.medicaments = orderBy($scope.medicaments, predicate, reverse);
    };
    $scope.confirmer = function(index)
    {
        $scope.id = $scope.medicaments[index].id;
        $(".popup").fadeTo(200,1);
        $(".popup").css('display','block');
    }
    $scope.annuler = function()
    {
        $(".popup").css('display','none');
    }
    $scope.supprimer = function()
    {
        window.location = "http://localhost/pharma/public/supprimer/medicament/" + $scope.id;
    }
});
app.controller("NoteController", function($scope, $filter)
{
    var orderBy = $filter('orderBy');
    $scope.order = function(predicate, reverse) {
        $scope.notes = orderBy($scope.notes, predicate, reverse);
    };
    $scope.confirmer = function(index)
    {
        $scope.id = $scope.notes[index].id;
        $(".popup").fadeTo(200,1);
        $(".popup").css('display','block');
    }
    $scope.annuler = function()
    {
        $(".popup").css('display','none');
    }
    $scope.supprimer = function()
    {
        window.location = "http://localhost/pharma/public/supprimer/note/" + $scope.id;
    }
    $scope.print = function(index)
    {
        id = '#note' + index;
        $("h2").css('display','none');
        $("label").css('display','none');
        $("input").css('display','none');
        $("tbody").css('display','none');
        $("thead").css('display','none');
        $("aside").css('display','none');
        $("header").css('display','none');
        $(id).css('display','block');
        $(id).css('position','absolute');
        $(id).css('top','10px');
        $(id).css('left','10px');
        $("a .fa").css('display','none');
        $("a .fa-arrow-circle-o-left").css('display','block');
        window.print();
    }
    $scope.printAll = function()
    {
        $("h2").css('display','none');
        $("label").css('display','none');
        $("input").css('display','none');
        $("aside").css('display','none');
        $("header").css('display','none');
        $("table").css('position','absolute');
        $("table").css('top','10px');
        $("table").css('left','10px');
        $("a .fa").css('display','none');
        $("button").css('display','none');
        $("thead a .fa-arrow-circle-o-left").css('display','block');
        window.print();
    }
});
app.controller("CommandeController", function($scope, $filter)
{
    var orderBy = $filter('orderBy');
    $scope.order = function(predicate, reverse) {
        $scope.commandes = orderBy($scope.commandes, predicate, reverse);
    };
    $scope.order_med = function(predicate, reverse) {
        $scope.medicaments = orderBy($scope.medicaments, predicate, reverse);
    };
    $scope.confirmer = function(index)
    {
        $scope.id = $scope.commandes[index].id;
        $(".popup").fadeTo(200,1);
        $(".popup").css('display','block');
    }
    $scope.annuler = function()
    {
        $(".popup").css('display','none');
    }
    $scope.supprimer = function()
    {
        window.location = "http://localhost/pharma/public/supprimer/commande/" + $scope.id;
    }
    $scope.print = function(index)
    {
        id = '#commande' + index;
        $("h2").css('display','none');
        $("label").css('display','none');
        $("input").css('display','none');
        $("tbody").css('display','none');
        $("thead").css('display','none');
        $("aside").css('display','none');
        $("header").css('display','none');
        $(id).css('display','block');
        $(id).css('position','absolute');
        $(id).css('top','10px');
        $(id).css('left','10px');
        $("a .fa").css('display','none');
        $("a .fa-arrow-circle-o-left").css('display','block');
        window.print();
    }
    $scope.printAll = function()
    {
        $("h2").css('display','none');
        $("label").css('display','none');
        $("input").css('display','none');
        $("aside").css('display','none');
        $("header").css('display','none');
        $("table").css('position','absolute');
        $("table").css('top','10px');
        $("table").css('left','10px');
        $("a .fa").css('display','none');
        $("button").css('display','none');
        $("thead a .fa-arrow-circle-o-left").css('display','block');
        window.print();
    }
});
