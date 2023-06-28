<?php

return [
    'reset' => 'Sua senha foi redefinida!',
    'sent' => 'Enviamos um e-mail com o link para redefinir sua senha!',
    'throttled' => 'Por favor, aguarde antes de tentar novamente.',
    'token' => 'Este token de redefinição de senha é inválido.',
    'required' => 'O campo :attribute é obrigatório.',
    'user' => 'Não conseguimos encontrar um usuário com esse endereço de e-mail.',

    'passwords.sent' => 'Link de redefinição de senha enviado com sucesso!',
    'passwords.reset' => 'Senha redefinida com sucesso!',
    'passwords.user' => 'Não foi possível encontrar um usuário com esse endereço de e-mail.',
    'passwords.token' => 'O token de redefinição de senha é inválido.',
    'passwords.throttled' => 'Tentativas de redefinição de senha excedidas. Por favor, aguarde antes de tentar novamente.',


    'Reset Password Notification' => 'Notificação de Redefinição de Senha',
    'You are receiving this email because we received a password reset request for your account.' => 'Você está recebendo este e-mail porque recebemos uma solicitação de redefinição de senha para a sua conta.',
    'Reset Password' => 'Redefinir Senha',
    'This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')] => 'Este link de redefinição de senha expirará em :count minutos.',
    'If you did not request a password reset, no further action is required.' => 'Se você não solicitou a redefinição de senha, nenhuma ação adicional é necessária.',

];