-- Drop database if it already exists --
DROP DATABASE IF EXISTS recipedb;

-- Create database if it doesn't already exist --
CREATE DATABASE IF NOT EXISTS recipedb;

-- Use this database --
USE recipedb;

/* Table Creates */
CREATE TABLE Person (
  PersonID INT(3) NOT NULL AUTO_INCREMENT,
  Username VARCHAR(25) NOT NULL,
  Password VARCHAR(255) NOT NULL,
  CONSTRAINT PK_Person PRIMARY KEY(PersonID)
);

CREATE TABLE Ingredient (
  IngredientID INT(3) NOT NULL AUTO_INCREMENT,
  Name VARCHAR(20) NOT NULL,
  CONSTRAINT PK_Ingredient PRIMARY KEY(IngredientID)
);

CREATE TABLE FoodType (
  FoodTypeID INT(3) NOT NULL AUTO_INCREMENT,
  Name VARCHAR(20) NOT NULL,
  CONSTRAINT PK_FoodType PRIMARY KEY(FoodTypeID)
);

CREATE TABLE Instruction (
  InstructionID INT(3) NOT NULL AUTO_INCREMENT,
  Details VARCHAR(255) NOT NULL,
  CONSTRAINT PK_Instruction PRIMARY KEY(InstructionID)
);

CREATE TABLE Recipe (
  RecipeID INT(3) NOT NULL AUTO_INCREMENT,
  Name VARCHAR(30) NOT NULL,
  Serving INT(2) NOT NULL,
  IngredientID INT(3) NOT NULL,
  FoodTypeID INT(3) NOT NULL,
  CONSTRAINT PK_Recipe PRIMARY KEY(RecipeID),
  CONSTRAINT FK_RecipeIngredient FOREIGN KEY(IngredientID) REFERENCES Ingredient(IngredientID) ON DELETE CASCADE,
  CONSTRAINT FK_RecipeFoodType FOREIGN KEY(FoodTypeID) REFERENCES FoodType(FoodTypeID) ON DELETE CASCADE
);

-- Link tables using composite keys
CREATE TABLE InstructionList (
  RecipeID INT(3) NOT NULL,
  InstructionID INT(3) NOT NULL,
  CONSTRAINT PK_InstructionList PRIMARY KEY(RecipeID, InstructionID),
  CONSTRAINT FK_InstructionListRecipe FOREIGN KEY(RecipeID) REFERENCES Recipe(RecipeID) ON DELETE CASCADE,
  CONSTRAINT FK_InstructionListInstruction FOREIGN KEY(InstructionID) REFERENCES Instruction(InstructionID) ON DELETE CASCADE
);

CREATE TABLE AccFav (
  PersonID INT(3) NOT NULL,
  RecipeID INT(3) NOT NULL,
  CONSTRAINT PK_AccFav PRIMARY KEY(PersonID, RecipeID),
  CONSTRAINT FK_AccFavPerson FOREIGN KEY(PersonID) REFERENCES Person(PersonID) ON DELETE CASCADE,
  CONSTRAINT FK_AccFavRecipe FOREIGN KEY(RecipeID) REFERENCES Recipe(RecipeID) ON DELETE CASCADE
);

-- Insert data
INSERT INTO Ingredient(Name) VALUES
                                  ('Onion'),
                                  ('Cheese');

INSERT INTO FoodType(Name) VALUES
                                ('Vegetarian'),
                                ('Contains Meat');

INSERT INTO Instruction(Details) VALUES
                                      ('Cook'),
                                      ('Boil'),
                                      ('Grate Cheese'),
                                      ('Cut ingredients');

INSERT INTO Recipe(Name, Serving, IngredientID, FoodTypeID) VALUES
                                                                ('Pizza', 2, 2, 1),
                                                                ('Ramen', 4, 1, 2);

INSERT INTO InstructionList VALUES
                                (1, 1),
                                (1, 3),
                                (2, 2),
                                (2, 4);
