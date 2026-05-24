<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book your lesson - DSKM Driving School</title>
    <link rel="icon" type="image/x-icon" href="../incl/images/logo2.png">
    <link rel="stylesheet" href="../incl/style/customers/customerBrowse.css">
</head>

<body>
<div class="container">

    <h1>Book a Driving Lesson</h1>
    <p class="subtitle">
        Select your learner's license code and choose your lesson package
    </p>
    
    <form 
        action="customerBooking.php" 
        method="post" 
        enctype="multipart/form-data"
    >

        <!-- LICENSE UPLOAD -->
        <h2>
            Upload Learner's Licence
            <span class="required-text">* Required</span>
        </h2>

        <input 
            type="file" 
            name="learners_license" 
            accept="image/*,application/pdf" 
            required
        >

            <!-- LICENSE CODES -->
            <h2>Select Learner's License Code</h2>

            <div class="license-grid">
                <div class="license-card">
                    <label>Code A: Motorcycle</label>
                    <img 
                        src="../incl/images/Motorcycle.png" 
                        alt="Motorcycle license icon"
                    >
                    <select name="code_a">
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                    </select>

                </div>

                <div class="license-card">
                    <label>Code B (08): Light Motor Vehicle</label>
                    <img 
                        src="../incl/images/Light Motor Vehicle.png" 
                        alt="Car license icon"
                    >
                    <select name="code_b">
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                    </select>
                </div>

                <div class="license-card">
                    <label>Code EB: Light Vehicle + Trailer</label>
                    <img 
                        src="../incl/images/Light Vehicle + Trailer.png" 
                        alt="Trailer license icon"
                    >
                    <select name="code_eb">
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                    </select>
                </div>

                <div class="license-card">
                    <label>Code C1/C (10): Medium/Heavy Trucks</label>
                    <img 
                        src="../incl/images/MediumTruck.png" 
                        alt="Truck license icon"
                    >
                    <select name="code_c1">
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                    </select>
                </div>

                <div class="license-card">
                    <label>Code EC (14): Heavy Trucks</label>
                    <img 
                        src="../incl/images/HeavyTruck.png" 
                        alt="Heavy truck icon"
                    >
                    <select name="code_ec">
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                    </select>
                </div>
            </div>

            <!-- PACKAGE SECTION -->
            <h2>Select Your Package</h2>

            <div class="package-scroll">
                <label class="package-card">
                    <input 
                        type="radio" 
                        name="package" 
                        value="200" 
                        required
                    >
                    <h3>R200</h3>
                    <p>1 x Lesson (Personal Car)</p>
                </label>

                <label class="package-card">
                    <input 
                        type="radio" 
                        name="package" 
                        value="300"
                    >
                    <h3>R300</h3>
                    <p>1 x Lesson (Driving School Car)</p>
                </label>

                <label class="package-card">
                    <input 
                        type="radio" 
                        name="package" 
                        value="1770"
                    >
                    <h3>R1770</h3>
                    <p>6 x Lessons (Driving School Car)</p>
                </label>

                <label class="package-card">
                    <input 
                        type="radio" 
                        name="package" 
                        value="2720"
                    >
                    <h3>R2720</h3>
                    <p>6 x Lessons + Test Car</p>
                </label>

                <label class="package-card">
                    <input 
                        type="radio" 
                        name="package" 
                        value="2900"
                    >
                    <h3>R2900</h3>
                    <p>10 x Lessons</p>
                </label>

                <label class="package-card">
                    <input 
                        type="radio" 
                        name="package" 
                        value="3850"
                    >
                    <h3>R3850</h3>
                    <p>10 x Lessons + Test Car</p>
                </label>

                <label class="package-card">
                    <input 
                        type="radio" 
                        name="package" 
                        value="5700"
                    >
                    <h3>R5700</h3>
                    <p>20 x Lessons</p>
                </label>

                <label class="package-card">
                    <input 
                        type="radio" 
                        name="package" 
                        value="6650"
                    >
                    <h3>R6650</h3>
                    <p>20 x Lessons + Test Car</p>
                </label>

            </div>

            <!-- SUBMIT -->
            <input 
                type="submit" 
                value="Book Lesson" 
                class="submit-btn"
            >
    </form>

    <a href="index.html" class="back-link">
        ← Logout
    </a>

</div>

</body>
</html>