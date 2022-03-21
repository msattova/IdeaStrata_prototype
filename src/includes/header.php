<!DOCTYPE html>
<html lang="ja" class="w-full">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <title>Idea Strata</title>
</head>

<body class="w-full pl-2 pr-2">
  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
  <header class="w-full mt-8 mb-5 mr-0 flex flex-row flex-wrap justify-end">
    <h1 class="ml-8 font-bold tracking-wider text-2xl flex-auto">
      Idea Strata
    </h1>
    <?php if (has_login()) : ?>
      <span class="mr-4">
        <a href="src/logout.php">ログアウト</a>
      </span>
    <?php endif; ?>
  </header>
