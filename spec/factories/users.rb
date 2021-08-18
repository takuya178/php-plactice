FactoryBot.define do
  factory :user do
    name { Faker::Internet.unique.name }
    email { Faker::Internet.unique.email }
    password { '1234567' }
    password_confirmation { '1234567' }
  end
end
