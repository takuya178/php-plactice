FactoryBot.define do
  factory :user do
    name { Faker::Name.name  }
    sequence(:email) { |n| "sample#{n}@example.com" }
    role { :general }
    password { 'password' }
    password_confirmation { 'password' }
  end

  trait :admin do
    name { Faker::Name.name }
    role { :admin }
  end
end
