<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Book your lesson</title>
</head>

<body>

    <h1>Book a driving lesson</h1>
    <p>Select the code of your learners</p>

    <form action="customerBooking.php" method="post">

        <!-- TUTORING SERVICES -->
        <h2>Code on the learners license</h2>
        <table border="1" cellpadding="5">

            <tr>
                <th>Service</th>
            
                <th>Select</th>
            </tr>

            <tr>
                <td>Code A: Motorcycle license </td>
            
                <td>
                    <select name="maths">
                        <option>No</option>
                        <option>Yes</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Code B (08): Light motor Vehicles</td>
        
                <td>
                    <select name="english">
                        <option>No</option>
                        <option>Yes</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Code EB: Light vehicle with heavy trailer</td>
       
                <td>
                    <select name="science">
                        <option>No</option>
                        <option>Yes</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Code C1/C (10): Medium/heavy rigid trucks </td>
               
                <td>
                    <select name="accounting">
                        <option>No</option>
                        <option>Yes</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Code EC (14):Heavy trucks</td>
               
                <td>
                    <select name="nbt_prep">
                        <option>No</option>
                        <option>Yes</option>
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
                    <select name="maths">
                        <option>No</option>
                        <option>Yes</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>R300 1 x Lesson with Driving School Car</td>
                <td>
                    <select name="maths">
                        <option>No</option>
                        <option>Yes</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>R1770 6 x Lesson with Driving School Car</td>
        
                <td>
                    <select name="english">
                        <option>No</option>
                        <option>Yes</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>R2720 6 x Lessons with our car and car rental for final test</td>
          
                <td>
                    <select name="science">
                        <option>No</option>
                        <option>Yes</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>R2900 10 x Lesson with Driving School Car</td>
                <td>
                    <select name="accounting">
                        <option>No</option>
                        <option>Yes</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>R3850 10 x Lessons with our car and car rental for final test</td>
            
                <td>
                    <select name="nbt_prep">
                        <option>No</option>
                        <option>Yes</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td> R5700 20 x Lesson with Driving School Car</td>

                <td>
                    <select name="past_papers">
                        <option>No</option>
                        <option>Yes</option>
                    </select>
                </td>
            </tr>

             <tr>
                <td>R6650 20 x Lessons with our car and car rental for final test</td>

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