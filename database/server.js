// jshint esversion:6

const express = require("express");
const bodyParser = require("body-parser");
const request = require("request");
const assert = require("assert");


const app = express();
app.use(bodyParser.urlencoded({
    extended: true
}));
app.use(express.static("public"));


app.post("/feedback", function (req, res) {
    res.send("Feedback Submitted Successfully!");
});

app.post("/book_ticket", function (req, res) {
    res.send('<div class="jumbotron jumbotron-fluid">< div class= "container" ><h1 class="display-4">Awesome!</h1><p class="lead">You have been successfully Registered!</p></div >');
});


app.listen(3000, function () {
    console.log("server is listening on port 3000.");
});