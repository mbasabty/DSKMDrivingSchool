<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Book a Tutoring Service</title>
</head>

<body>

    <h1>Book a Tutoring Service</h1>
    <p>Select the tutoring services you need.</p>

    <form action="customerBooking.php" method="post">

        <!-- TUTORING SERVICES -->
        <h2>Tutoring Services</h2>

        <table border="1" cellpadding="5">

            <tr>
                <th>Service</th>
                <th>Price</th>
                <th>Select</th>
            </tr>

            <tr>
                <td>Mathematics Tutoring</td>
                <td>R150</td>
                <td>
                    <select name="maths">
                        <option>No</option>
                        <option>Yes</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>English Tutoring</td>
                <td>R120</td>
                <td>
                    <select name="english">
                        <option>No</option>
                        <option>Yes</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Science Tutoring</td>
                <td>R180</td>
                <td>
                    <select name="science">
                        <option>No</option>
                        <option>Yes</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Accounting Tutoring</td>
                <td>R170</td>
                <td>
                    <select name="accounting">
                        <option>No</option>
                        <option>Yes</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>NBT Preparation</td>
                <td>R250</td>
                <td>
                    <select name="nbt_prep">
                        <option>No</option>
                        <option>Yes</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Exam Past Papers</td>
                <td>R80</td>
                <td>
                    <select name="past_papers">
                        <option>No</option>
                        <option>Yes</option>
                    </select>
                </td>
            </tr>

        </table>

        <br>

        <input type="submit" value="Book Tutoring">

    </form>

    <br>

    <a href="index.php">Back to Home</a>

</body>
</html>