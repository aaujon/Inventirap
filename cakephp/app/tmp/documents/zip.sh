#!/bin/bash

cd $1/generator;

mkdir $1/$2;

zip -r $1/$2/$3 ./;
