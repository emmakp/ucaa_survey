
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Department</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        #departmentOverlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            /* background:  #007bff; */
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            color: white;
            z-index: 1000;
        }
        #departmentOverlay button {
            margin: 10px;
            padding: 10px 20px;
            font-size: 16px;
            /* background-color: #007bff; Bootstrap primary blue */
            /* background: rgba(0, 0, 0, 0.8); */

            color: black;
            border: none;
            border-radius: 5px;
            /* color: white; */
            transition: background-color 0.3s;
        }
        /* #departmentOverlay button:hover {
            background-color: #0056b3; 
        } */
        #departmentOverlay h2 {
            margin-bottom: 20px;
        }
        #departmentOverlay p {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div id="departmentOverlay">
        <!-- <h2>Select a Department</h2> -->
        <h2>  Which Areas would you want to give your Feedback?</h2>

        @forelse ($departments as $department)
            <button 
                onclick="window.location.href='{{ route('survey.questions', ['surveyId' => $survey_id, 'audienceType' => $audience_type, 'department' => str_replace(' ', '%20', $department)]) }}'">
                {{ $department }}
            </button>
        @empty
            <p>No departments available for this survey and audience type.</p>
        @endforelse
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>