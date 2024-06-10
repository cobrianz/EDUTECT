<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDUTECH</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
    <style>

        .navbar {
            border-radius: 0;
            padding: 1rem 4rem;
        }

        @media only screen and (max-width: 800px) {
            .navbar {
                padding: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="container" style="margin: 0; width: 100%; padding: 0;">
        <nav style="margin: 0; padding: 0; border-radius: none;">
            <div class="navbar">
                <div class="logo">
                    <a href="index.php">
                        <img src="./assets/logo.png" alt="">
                    </a>
                    <div class="nav_details" onclick="toggleAside()">
                        <span><i class="fa fa-bars" aria-hidden="true"></i></span>
                        <span>Menu</span>
                    </div>
                </div>

                <div class="nav__right">
                    <div class="user">
                        <a href="./account.php"><span><i class="fa fa-user-o" aria-hidden="true"></i></span></a>
                    </div>
                    <div><i class="fa fa-code" aria-hidden="true"></i></div>
                </div>
            </div>
        </nav>
    </div>
    <div class="learn_hero">
        <main class="learn">
            <aside id="courseOutline">
                <div class="course-outline">
                    <h2>Course Outline</h2>
                    <div class="course">
                        <div class="topic" onclick="toggleSubtopics(this)">
                            <h4>Introduction <i class="fas fa-chevron-down"></i></h4>
                            <ul class="subtopics">
                                <li>Overview of the Course</li>
                                <li>Introduction to HTML</li>
                                <li>Introduction to CSS</li>
                                <li>Introduction to JavaScript</li>
                            </ul>
                        </div>

                        <div class="topic" onclick="toggleSubtopics(this)">
                            <h4>HTML Basics <i class="fas fa-chevron-down"></i></h4>
                            <ul class="subtopics">
                                <li>Elements and Tags</li>
                                <li>Attributes</li>
                                <li>Forms and Inputs</li>
                                <li>Semantic HTML</li>
                            </ul>
                        </div>

                        <div class="topic" onclick="toggleSubtopics(this)">
                            <h4>CSS Basics <i class="fas fa-chevron-down"></i></h4>
                            <ul class="subtopics">
                                <li>Selectors and Properties</li>
                                <li>Box Model</li>
                                <li>Flexbox</li>
                                <li>Grid</li>
                            </ul>
                        </div>

                        <div class="topic" onclick="toggleSubtopics(this)">
                            <h4>JavaScript Basics <i class="fas fa-chevron-down"></i></h4>
                            <ul class="subtopics">
                                <li>Variables and Data Types</li>
                                <li>Operators</li>
                                <li>Conditional Statements</li>
                                <li>Loops</li>
                            </ul>
                        </div>

                        <div class="topic" onclick="toggleSubtopics(this)" style="border-bottom: none;">
                            <h4>DOM Manipulation <i class="fas fa-chevron-down"></i></h4>
                            <ul class="subtopics">
                                <li>Understanding the DOM</li>
                                <li>DOM Traversal</li>
                                <li>Manipulating DOM Elements</li>
                                <li>Event Handling</li>
                                <li>Creating and Deleting Elements</li>
                            </ul>
                        </div>
                    </div>
            </aside>
            <section class="content">
                <div class="video">
                    <h2>Understanding the DOM</h2>
                    <video controls>
                        <source src="./assets/video.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <div class="content_bottom">
                        <p>Instructor: <span>Braison Wabwire</span></p>
                        <button><span>Next Lesson</span> <span><i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </span></button>
                    </div>
                </div>
                <div class="notes">
                    <div class="about">
                        <h2>JavaScript DOM (Document Object Model)</h2>
                        <p>The Document Object Model (DOM) is a programming interface for web documents. It represents
                            the page so that programs can change the document structure, style, and content. The DOM
                            provides a way for JavaScript to interact with HTML and XML documents.</p>

                        <h2>Understanding the DOM</h2>
                        <p>The DOM represents an HTML or XML document as a tree structure where each node is an object
                            representing a part of the document. Nodes can be elements, attributes, text content, etc.
                            In HTML, the &lt;html&gt; element is the root node, and all other elements are descendants.
                        </p>

                        <h2>DOM Tree Structure</h2>
                        <p>The DOM tree is a hierarchical structure of nodes representing the elements of the HTML
                            document. For example, an HTML document with a head and body section will have a root node
                            &lt;html&gt; with child nodes for &lt;head&gt; and &lt;body&gt;. The body might have further
                            child nodes like headings and paragraphs, forming a tree-like structure.</p>

                        <h2>Accessing the DOM with JavaScript</h2>
                        <p>JavaScript can be used to access and manipulate the DOM. Some common methods to select
                            elements include:</p>
                        <ul>
                            <li>Selecting an element by its ID.</li>
                            <li>Selecting all elements with a given class name.</li>
                            <li>Selecting all elements with a given tag name.</li>
                            <li>Selecting the first element that matches a CSS selector.</li>
                            <li>Selecting all elements that match a CSS selector.</li>
                        </ul>

                        <h2>DOM Manipulation</h2>
                        <p>JavaScript can modify the content, structure, and style of the document dynamically. Some
                            common tasks include:</p>
                        <ul>
                            <li><strong>Changing Content:</strong> Modifying the inner HTML or text content of an
                                element.</li>
                            <li><strong>Changing Attributes:</strong> Altering the attributes of HTML elements, such as
                                the source of an image.</li>
                            <li><strong>Changing Styles:</strong> Adjusting the CSS styles of elements directly via
                                JavaScript.</li>
                            <li><strong>Creating New Elements:</strong> Dynamically adding new elements to the document.
                            </li>
                            <li><strong>Removing Elements:</strong> Deleting elements from the document.</li>
                        </ul>

                        <h2>Event Handling</h2>
                        <p>Events are actions or occurrences that happen in the browser, such as clicks, key presses, or
                            page loads. JavaScript can respond to these events using event listeners, allowing dynamic
                            interactions like displaying alerts when a button is clicked or changing the content when
                            certain events occur.</p>

                        <h2>DOM Traversal</h2>
                        <p>DOM traversal allows navigation through the DOM tree to access different nodes. Some common
                            properties and methods include:</p>
                        <ul>
                            <li>Getting the parent node of the current node.</li>
                            <li>Accessing a list of the child nodes of the current node.</li>
                            <li>Getting the first and last child nodes.</li>
                            <li>Navigating to the next or previous sibling nodes.</li>
                        </ul>

                        <h2>Example: Manipulating the DOM</h2>
                        <p>An example of DOM manipulation could involve changing the content of a paragraph and
                            responding to a button click. When the button is clicked, the content of a specific
                            paragraph changes, demonstrating how JavaScript can interact with the DOM to create dynamic
                            web pages.</p>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <script src="app.js"></script>
</body>

</html>