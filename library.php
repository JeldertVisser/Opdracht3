<?php
$books = [
    ["author" => "J.K. Rowling", "title" => "Harry Potter", "ISBN" => "9789076174082", "publisher" => "Bloomsbury", "date" => "26-6-1997", "pages" => "223"],
    ["author" => "Stephen King", "title" => "the Shining", "ISBN" => "9780307743657", "publisher" => "Doubleday", "date" => "28-1-1977", "pages" => "505"],
    ["author" => "Dan Brown", "title" => "Inferno", "ISBN" => "9789021020884", "publisher" => "Doubleday", "date" => "14-5-2013", "pages" => "642"],
    ["author" => "Dan Brown", "title" => "Fake Book", "ISBN" => "big number", "publisher" => "Tripleday", "date" => "right now", "pages" => "a billion"]
];
$authors = ["J.K. Rowling", "Stephen King", "Dan Brown"];

//changes remain during runtime, so you can add/remove a book and see the changes with Show list
function mainMenu()
{
    while (true) {
        print_r("\r\nWelcome to the main menu.
    Add book
    Remove book
    Show list
    Show author
    Exit\r\n");
        $option = readline("Please make your selection: ");
        switch ($option) {
            case "Add book":
                addBook();
                break;
            case "Remove book":
                removeBook();
                break;
            case "Show list":
                showlist();
                break;
            case "Show author":
                showAuthor();
                break;
            //returning to avoid infinite loop
            case "Exit";
                return;
            default:
                print_r("please select a valid option\r\n");
        }
    }
}

function addBook()
{
    global $authors, $books;
    print_r("Authors:\r\n");
    foreach ($authors as $author) {
        print_r($author . "\r\n");
    }
    while (true) {
        $author = readline("Select the author you wish to add a book to: ");
        if (in_array($author, $authors)) {
            $title = readline("Please name the book you would like to add: ");
            $ISBN = readline("Please enter the ISBN of the book: ");
            $publisher = readline("Please enter the publisher of the book: ");
            $date = readline("Please enter the publish date of the book: ");
            $pages = readline("Please enter the number of pages of the book: ");
            $books[] = ["author" => $author, "title" => $title, "ISBN" => $ISBN, "publisher" => $publisher, "date" => $date, "pages" => $pages];
            // var_dump($books);
            break;
        } else {
            print_r("Please select an author from the list \r\n");
        }
    }
}

function removeBook()
{
    global $books;
    foreach ($books as $book) {
        print_r($book["title"] . "\r\n");
    }
    $option = readline("Please select the book you would like to remove: ");
    $key = array_search($option, array_column($books, 'title'));
    if (!$key) {
        print_r("$option does not seem to exist...");
    } else {
        array_splice($books, $key, 1);
        var_dump($books);
        print_r("$option has been removed.");
    }

}

function showList()
{
    global $books;
    if (!$books) {
        print_r("There are no books available :(");
    }
    sort($books);
    foreach ($books as $book) {
        print_r("\r\n");
        foreach ($book as $key => $info) {
            print_r($key . ": " . $info . "\r\n");
        }
    }
}

function showAuthor()
{
    global $books;
    global $authors;
    $author = readline("Please select the author whose books you'd like to see: ");
    if (in_array($author, $authors)) {
        foreach ($books as $book) {
            if ($author == $book["author"]) {
                print_r("\r\n");
                foreach ($book as $key => $info) {
                    print_r($key . ": " . $info . "\r\n");
                }
            }
        }
    } else {
        print_r("$author is not in the list...");
    }
}

//starts the program (duh). will keep running until you Exit from main menu (or force close)
mainMenu();

/// these are for testing individual parts
// addbook();
// removeBook();
// showList();
// showAuthor();

