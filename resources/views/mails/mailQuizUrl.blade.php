<!DOCTYPE html>
<html>
<head>
    <title>Quiz</title>
</head>
<body>
<p>
Nous tenons à vous remercier pour l'intérêt que vous avez manifesté en postulant chez Pyxicom. Nous apprécions votre enthousiasme et votre désir de vous joindre à notre équipe.
</p>
<p>
Dans le cadre du processus de sélection, nous aimerions vous inviter à participer à un quiz qui nous permettra de mieux évaluer vos compétences et vos connaissances. Veuillez cliquer sur le lien ci-dessous pour accéder au quiz :
</p>
<p style="text-align: center;">
<button



style="
 background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  border-radius:15px;
  cursor:pointer;
  padding: 8px 20px;
"><a href="{{ $data['url'] }}" style="text-decoration: none;color: white;">Commencer le quiz</a> </button>
</p>

<p>
    Lien de quiz <br>
    <span style="color: #4CAF50;">
    {{ $data['url'] }}
    </span>

</p>
<p>Pyxicom</p>
</body>
</html>
