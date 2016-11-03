CREATE TABLE "token" ("id" INTEGER PRIMARY KEY  AUTOINCREMENT  NOT NULL  UNIQUE , "name" VARCHAR, "picture" VARCHAR, "token" VARCHAR, "is_active" BOOL, "created_at" DATETIME, "updated_at" DATETIME)

CREATE TABLE "tag" ("id" INTEGER PRIMARY KEY  AUTOINCREMENT  NOT NULL  UNIQUE , "name" VARCHAR, "is_active" BOOL DEFAULT 1, "created_at" DATETIME, "updated_at" DATETIME)

CREATE TABLE "feed" ("id" INTEGER PRIMARY KEY  AUTOINCREMENT  NOT NULL  UNIQUE ,"picture_s" TEXT,"picture_m" TEXT,"picture_l" TEXT,"name" VARCHAR, "profile_pic" TEXT,"caption" TEXT DEFAULT (null) ,"post_picture" TEXT,"post_id" TEXT,"created_at" DATETIME,"updated_at" DATETIME,"tag_id" INTEGER DEFAULT (null) ,"post_location" VARCHAR)