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
    res.redirect("/main.html");
});



app.listen(3000, function () {
    console.log("server is listening on port 3000.");
});