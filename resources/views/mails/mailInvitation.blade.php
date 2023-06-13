<!DOCTYPE html>
<html>
<head>
    <title>Example Email</title>
</head>
<body>
<h5>Cher(e) stagiaire potentiel,</h5>
<p>
    Nous avons le plaisir de vous inviter à passer un entretien pour un stage chez Pyxicom. Votre candidature a été retenue et nous souhaitons en apprendre davantage sur vous.
</p>

<p>
    L'entretien est prévu le <strong>{{ $data['dateEntretien'] }} à {{ $data['heureEntretien'] }}</strong>  à notre bureau situé à [adresse]. Nous vous prions d'arriver à l'heure.
</p>

<p>
    L'entretien consistera en une discussion pour mieux comprendre vos motivations, compétences et objectifs de carrière. N'oubliez pas d'apporter votre CV et tout autre document pertinent.
</p>

<p>
    Si vous avez des besoins spécifiques pour l'entretien, veuillez nous en informer à l'avance.
</p>

<p>
    Nous apprécions votre intérêt pour Pyxicom et sommes impatients de vous rencontrer.
</p>
<p>Cordialement,</p>

<p>Hassan AIT TAMAA</p>

<p>Pyxicom</p>
</body>
</html>