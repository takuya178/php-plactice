class ApplicationMailer < ActionMailer::Base
  default from: Rails.application.credentials.gmail[:GMAIL_USER_NAME]
  layout 'mailer'
end
