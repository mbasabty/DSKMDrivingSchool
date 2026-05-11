<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Book your lesson</title>
</head>

<body>

<h1>Book a driving lesson</h1>
<p>Select the code of your learners and upload your licence</p>

<form action="customerBooking.php" method="post" enctype="multipart/form-data">

    <!-- 🚨 MANDATORY UPLOAD -->
    <h2>Upload Learner's Licence (Required)</h2>
    <input type="file" name="learners_license" accept="image/*,application/pdf" required>
    <br><br>

    <!-- TUTORING SERVICES -->
    <h2>Code on the learners license</h2>
    <table border="1" cellpadding="5">

        <tr>
            <th>Service</th>
            <th>Select</th>
        </tr>

        <tr>
            <td>Code A: Motorcycle license</td>
            <td>
                <select name="code_a">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select>
            </td>
        </tr>

        <tr>
            <td>Code B (08): Light motor Vehicles</td>
            <td>
                <select name="code_b">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select>
            </td>
        </tr>

        <tr>
            <td>Code EB: Light vehicle with heavy trailer</td>
            <td>
                <select name="code_eb">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select>
            </td>
        </tr>

        <tr>
            <td>Code C1/C (10): Medium/heavy rigid trucks</td>
            <td>
                <select name="code_c1">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select>
            </td>
        </tr>

        <tr>
            <td>Code EC (14): Heavy trucks</td>
            <td>
                <select name="code_ec">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select>
            </td>
        </tr>

    </table>

    <br>

    <p>Select your package</p>

    <table border="1" cellpadding="5">

        <tr>
            <th>Package</th>
            <th>Select</th>
        </tr>

        <tr>
            <td>R200 1 x Lesson with personal Car</td>
            <td>
                <select name="pkg_200">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select>
            </td>
        </tr>

        <tr>
            <td>R300 1 x Lesson with Driving School Car</td>
            <td>
                <select name="pkg_300">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select>
            </td>
        </tr>

        <tr>
            <td>R1770 6 x Lessons with Driving School Car</td>
            <td>
                <select name="pkg_1770">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select>
            </td>
        </tr>

        <tr>
            <td>R2720 6 x Lessons + car rental for test</td>
            <td>
                <select name="pkg_2720">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select>
            </td>
        </tr>

        <tr>
            <td>R2900 10 x Lessons</td>
            <td>
                <select name="pkg_2900">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select>
            </td>
        </tr>

        <tr>
            <td>R3850 10 x Lessons + test car</td>
            <td>
                <select name="pkg_3850">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select>
            </td>
        </tr>

        <tr>
            <td>R5700 20 x Lessons</td>
            <td>
                <select name="pkg_5700">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select>
            </td>
        </tr>

        <tr>
            <td>R6650 20 x Lessons + test car</td>
            <td>
                <select name="pkg_6650">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select>
            </td>
        </tr>

    </table>

    <br>

    <input type="submit" value="Book Lesson">

</form>

<br>

<a href="index.php">Back to Home</a>

</body>
</html>