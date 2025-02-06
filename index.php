<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Git Cheat Sheet</title>
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <h1>Git Cheat Sheet</h1>
        <p>Your ultimate reference for mastering Git commands</p>
        <input type="text" class="search-bar" placeholder="Search for commands...">
    </div>
</section>

<div class="container my-5">
    <div class="row">
        <!-- Sidebar Navigation -->
        <div class="col-md-3">
            <div class="sidebar">
                <h4>Quick Navigation</h4>
                <ul>
                    <li><a href="#popular-commands">Popular Commands</a></li>
                    <li><a href="#about">About Git</a></li>
                    <li><a href="#contact">Contact Us</a></li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <!-- Popular Git Commands Section -->
            <section id="popular-commands">
                <h2>Popular Git Commands</h2>
                <div class="command-card">
                    <p class="command-title"><strong>git clone</strong></p>
                    <p>Clone a repository into a new directory.</p>
                    <button class="copy-btn btn btn-primary">Copy</button>
                </div>
                <div class="command-card">
                    <p class="command-title"><strong>git status</strong></p>
                    <p>Show the working tree status.</p>
                    <button class="copy-btn btn btn-primary">Copy</button>
                </div>
                <div class="command-card">
                    <p class="command-title"><strong>git commit</strong></p>
                    <p>Record changes to the repository.</p>
                    <button class="copy-btn btn btn-primary">Copy</button>
                </div>
                <div class="command-card">
                    <p class="command-title"><strong>git push</strong></p>
                    <p>Update remote refs along with associated objects.</p>
                    <button class="copy-btn btn btn-primary">Copy</button>
                </div>
            </section>

            <!-- Git Cheat Sheet Section -->
            <div class="git-cheat-sheet">
                <h2 class="text-center my-4">Git Cheat Sheet</h2>

                <?php
                require_once 'db.php';

                $sql = "SELECT * FROM commands WHERE status = 'approved'";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['description']); ?></h5>
                            <pre class="command-text">
                                <?php
                                    $command = htmlspecialchars($row['command']);
                                    $command = preg_replace_callback('/&lt;(.*?)&gt;/', function ($matches) {
                                        return '<span class="editable" contenteditable="true">' . htmlspecialchars($matches[1]) . '</span>';
                                    }, $command);
                                    echo $command;
                                ?>
                            </pre>
                            <button class="copy-btn btn btn-primary">Copy</button>
                        </div>
                    </div>
                <?php endwhile; ?>

                <div class="text-center">
                    <a href="add_command.php" class="btn btn-success">Add Your Own Command</a>
                </div>
            </div>

            <!-- About Git Section -->
            <section id="about" class="my-5">
                <h2>About Git</h2>
                <p>Git is a version control system that lets you manage and track your source code history. It was created by Linus Torvalds in 2005 and is now one of the most widely used systems in the world.</p>
            </section>

        </div>
    </div>
</div>

<!-- Contact Section -->
<section id="contact" class="py-5">
    <div class="container">
        <div class="row">
            <!-- Contact Information -->
            <div class="col-md-6 contact-info">
                <h4>Contact Information</h4>
                <p>If you have any questions, feel free to reach out to us:</p>
                <ul>
                    <li><i class="fas fa-envelope"></i> info@example.com</li>
                    <li><i class="fas fa-phone"></i> +123 456 7890</li>
                    <li><i class="fas fa-map-marker-alt"></i> 123 Git Lane, Code City</li>
                </ul>
            </div>

            <!-- Contact Form -->
            <div class="col-md-6">
                <h4>Send Us a Message</h4>
                <form class="contact-form">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Your Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Your Email" required>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Your Message" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <p>Munnaa &copy; 2024</p>
    <div class="social-links">
        <a href="#" class="fab fa-facebook"></a>
        <a href="#" class="fab fa-twitter"></a>
        <a href="#" class="fab fa-linkedin"></a>
        <a href="#" class="fab fa-github"></a>
    </div>
</footer>

<script src="script.js"></script>
<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        $(".copy-btn").click(function() {
            var commandHtml = $(this).closest(".card-body").find(".command-text").html();

            var tempElement = $("<div>").html(commandHtml);
            tempElement.find(".editable").each(function() {
                var text = $(this).text(); 
                $(this).replaceWith(text); 
            });

            var finalCommand = tempElement.text().trim(); 

            var tempInput = $("<textarea>");
            $("body").append(tempInput);
            tempInput.val(finalCommand).select();
            document.execCommand("copy");
            tempInput.remove();

            $(this).text("Copied!").addClass("btn-copied").removeClass("copy-btn");
            setTimeout(() => {
                $(this).text("Copy").removeClass("btn-copied").addClass("copy-btn");
            }, 2000);
        });
    });
</script>
</body>
</html>
