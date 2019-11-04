create table "gets"(
    "id" int(8) not null auto_increment,
    "src" varchar(255) not null,
    "dst" varchar(255) not null,
    primary key("id")
);
create table "posts"(
    id int(8) not null auto_increment,
    src varchar(255) not null,
    dst varchar(255) not null,
    primary key(id)
)