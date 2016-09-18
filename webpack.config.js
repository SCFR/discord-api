var webpack = require("webpack");


module.exports = {
    entry: "./app/main.js",
    context: __dirname,
    node: {
      __dirname: true,
    },
    output: {
        path: './js/',
        filename: "StarCitizenFR.discord.js",
        //libraryTarget: "var",
        //library: "StarCitizenFR",
    },
    module: {},
    plugins: [],
};
